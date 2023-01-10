<?php

namespace App\Controller;

use App\Repository\PodcastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FavoritoController extends AbstractController
{
    #[Route('/favorito', name: 'app_favorito')]
    public function favoritos(PodcastRepository $podcastRepository) {
        
        $podcasts = $podcastRepository->findBy([
            'favorito' => $this->getUser()
        ]);

        return $this->render('index/index.html.twig', [
            'podcasts' => $podcasts,
        ]);

    }






       /*#[Route('/editar-Favorito', name: 'app_editar_favorito')]
    public function editarFavorito(PodcastRepository $podcastRepository, Request $request) {
       if ($request->isXmlHttpRequest()) {
        $idPodcast = $request->get('id');
        $entityManager = $request->getDoctrine()->getManager();
        $podcast = $podcastRepository->findById($idPodcast);
        $podcast->setFavorito(!$podcast->getFavorito);
       
        try{
            $entityManager->flush();

        }catch (\Exception $e) {
            $actualizado = false;
        }
        return $this->json([
            'actualizado' => $actualizado
        ]);

       }
       throw $this->createNotFoundExcepcion();

    }*/

}
