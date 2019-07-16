<?php

namespace App\Controller;

use App\Entity\Artist;
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

    /**
     * @Route("/{id}", name="artist_show")
     * @param Artist $artist
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showArtist(Artist $artist)
    {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist
        ]);
    }

    /**
     * @Route("circus/histoire", name="circus_history")
     */
    public function history()
    {
        return $this->render('circus/history.html.twig');

    }
}
