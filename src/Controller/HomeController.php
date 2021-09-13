<?php

namespace App\Controller;
use App\Repository\BrandRepository;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'home', methods: ['GET'])]
    public function index(BrandRepository $brandRepository, ProductRepository $productRepository): Response
    {
        return $this->render('pages/home.html.twig', [
            'brands' => $brandRepository->findAll(),
            'products' => $productRepository->findAll(),
        ]);
    }
}
