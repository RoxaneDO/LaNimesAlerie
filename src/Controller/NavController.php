<?php

namespace App\Controller;

use App\Repository\BrandRepository;
use App\Repository\CategoryRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NavController extends AbstractController
{
    #[Route('/nav', name: 'nav')]
    public function index(BrandRepository $brandRepository, CategoryRepository $categoryRepository): Response
    {
        return $this->render('content/navigation.html.twig', [
            'brands' => $brandRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }
}
