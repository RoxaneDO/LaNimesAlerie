<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeaderController extends AbstractController
{
    #[Route('/header', name: 'header')]
    public function index(): Response
    {
        return $this->render('header/index.html.twig', [
            'controller_name' => 'HeaderController',
        ]);
    }
}
