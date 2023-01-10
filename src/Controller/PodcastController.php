<?php

namespace App\Controller;

use App\Entity\Podcast;
use App\Form\PodcastType;
use App\Repository\PodcastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/podcast')]
class PodcastController extends AbstractController
{
    

    #[Route('/new', name: 'app_podcast_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PodcastRepository $podcastRepository): Response
    {
        $podcast = new Podcast();
        $form = $this->createForm(PodcastType::class, $podcast);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $podcastRepository->save($podcast, true);
            $this->addFlash('success', 'Podcast creado correctamente!');

            return $this->redirectToRoute('app_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('podcast/new.html.twig', [
            'podcast' => $podcast,
            'form' => $form->createView(),
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
