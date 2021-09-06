<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/nav', name: 'nav')]
    public function index(): Response
    {
        return $this->render('content/navigation.html.twig', [
            'controller_name' => 'NavController',
        ]);
    }
}
