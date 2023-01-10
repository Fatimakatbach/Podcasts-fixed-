<?php

namespace App\Controller;

use App\Repository\PodcastRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PodcastAdminController extends AbstractController
{
    #[Route('/podcast/admin', name: 'app_podcast_admin')]
    public function index(PodcastRepository $podcastRepository): Response
    {
        $podcasts = $podcastRepository->findBy([
            'usuario' => $this->getUser()
        ]);
        return $this->render('podcast_admin/index.html.twig', [
            'podcastsAdmin' => $podcastRepository->findAll(),
        ]);
    }
}
