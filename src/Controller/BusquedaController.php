<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BusquedaController extends AbstractController
{
/* #[Route('/buscar/{busqueda}', name: 'app_busqueda')]
    public function busqueda(string $busqueda, PodcastRepository $podcastRepository, Request $request) {
        $formularioBusqueda = $this->createForm(BuscadorType::class);
        $formularioBusqueda->handleRequest($request);
        if ($formularioBusqueda->isSubmitted()) {
            if($formularioBusqueda->isSubmitted())
            {
                $busqueda = $formularioBusqueda->get('busqueda')->getData();
            }
        }
        if (!empty($busqueda)) {
            $podcasts = $podcastRepository->get('busqueda')->getData();
        }
        if ((!empty($busqueda)) || $formularioBusqueda->isSubmitted()) {
            return $this->render('index/index.html.twig',[
                'formulario_busqueda' => $formularioBusqueda->createView(),
                'podcasts' => $podcasts
            ]);

        }
     
        return $this->render('comunes/_buscador.html.twig',[
            'formulario_busqueda' => $formularioBusqueda->createView()
        ]);
    

    }*/
}
