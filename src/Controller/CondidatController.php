<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CondidatController extends AbstractController
{
    #[Route('/condidat', name: 'app_condidat')]
    public function index(): Response
    {
        return $this->render('condidat/index.html.twig', [
            'controller_name' => 'CondidatController',
        ]);
    }
}
