<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\PodcastType;
use App\Repository\PodcastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/podcast')]
class PodcastController extends AbstractController
{
    #[Route('/index', name: 'app_podcast_index', methods: ['GET'])]
    public function index(PodcastRepository $podcastRepository): Response
    {
        return $this->render('podcast/index.html.twig', [
            'podcasts' => $podcastRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_podcast_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PodcastRepository $podcastRepository, SluggerInterface $slugger): Response
    {
        $podcast = new Podcast();
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imagenFile = $form->get('imagen')->getData();//
            if ($imagenFile) {
                $originalFilename = pathinfo($imagenFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imagenFile->guessExtension();
                try {
                    $imagenFile->move(
                        $this->getParameter('imagenes_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    throw new \Exception( message: 'ups archivo no valido');   
                }

                $podcast->setImagen($newFilename);//

            }
            $podcastRepository->save($podcast, true);
            $this->addFlash('success', 'Podcast creado correctamente!');

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('podcast/new.html.twig', [
            'podcast' => $podcast,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_podcast_show', methods: ['GET'])]
    public function show(Podcast $podcast): Response
    {
        return $this->render('podcast/show.html.twig', [
            'podcast' => $podcast,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_podcast_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Podcast $podcast, PodcastRepository $podcastRepository): Response
    {
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $podcastRepository->save($podcast, true);
            $this->addFlash('success', 'Podcast editado correctamente!');

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('podcast/edit.html.twig', [
            'podcast' => $podcast,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_podcast_delete', methods: ['POST'])]
    public function delete(Request $request, Podcast $podcast, PodcastRepository $podcastRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$podcast->getId(), $request->request->get('_token'))) {
            $podcastRepository->remove($podcast, true);
            $this->addFlash('success', 'Podcast eliminado correctamente!');
        }

        return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
    }
}
