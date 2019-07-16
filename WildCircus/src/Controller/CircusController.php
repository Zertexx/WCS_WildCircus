<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CircusController extends AbstractController
{
    /**
     * @Route("/", name="circus_index")
     * @param ArtistRepository $artistRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ArtistRepository $artistRepository)
    {
        return $this->render('circus/index.html.twig', [
            'artists' => $artistRepository->findAllArtistsWithPerformance(),
        ]);
    }
}
