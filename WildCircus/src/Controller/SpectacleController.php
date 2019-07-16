<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SpectacleController extends AbstractController
{
    /**
     * @Route("/spectacle/programme", name="spectacle_program")
     */
    public function showSpectacles(PerformanceRepository $performanceRepository)
    {
        return $this->render('spectacle/program.html.twig', [
            'performances' => $performanceRepository->findAllPerfsWithSpectacleAndArtist(),
        ]);
    }
}
