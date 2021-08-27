<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // utiliser la méthode render, qui permet d'étendre un template
use Symfony\Component\HttpFoundation\Response; // outil qui permet d'utiliser récupérer les requetes http pour retourner un résultat, pour renvoyer les réponses
use Symfony\Component\Routing\Annotation\Route;


class PagesController extends AbstractController
{
    #[Route('/cgv', name: 'cgv')]
    public function cgv(): Response
    {
        return $this->render('pages/cgv.html.twig', ['title' => 'Page des Conditions Generales de Vente']);
    }

    #[Route('/mentionsLegales', name: 'mentionsLegales')]
    public function mentionLegale(): Response
    {
        return $this->render('pages/mentionsLegales.html.twig', ['title' => 'Page des mentions légales']);
    }

    #[Route('/politiqueConfidentialite', name: 'politiqueConfidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('pages/politiqueConfidentialite.html.twig', ['title' => 'Page des Politiques de confidentialité']);
    }

}

?>
