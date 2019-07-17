<?php

namespace App\Controller;

use App\Repository\SpectacleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpectacleController extends AbstractController
{
    /**
     * @Route("/spectacle/programme", name="spectacle_program")
     * @param SpectacleRepository $spectacleRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showSpectacles(SpectacleRepository $spectacleRepository)
    {
        return $this->render('spectacle/program.html.twig', [
            'spectacles' => $spectacleRepository->findAllSpectacleWithPerf(),
        ]);
    }
}
