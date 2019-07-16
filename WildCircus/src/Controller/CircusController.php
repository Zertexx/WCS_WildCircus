<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CircusController extends AbstractController
{
    /**
     * @Route("/circus", name="circus")
     */
    public function index()
    {
        return $this->render('circus/index.html.twig', [
            'controller_name' => 'CircusController',
        ]);
    }
}
