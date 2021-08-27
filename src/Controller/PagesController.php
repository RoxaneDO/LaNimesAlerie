<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // utiliser la méthode render, qui permet d'étendre un template
use Symfony\Component\HttpFoundation\Response; // outil qui permet d'utiliser récupérer les requetes http pour retourner un résultat, pour renvoyer les réponses

#[Route('/')]
class ContentController extends AbstractController
{
    #[Route('/cgv', name: 'cgv')]
    public function cgv(string $title): Response
    {
        return $this->render('pages/cgv.html.twig', ['title' => $title, 'description' => 'Page des Conditions Generales de Vente']);
    }

    #[Route('/mentionsLegales', name: 'mentionsLegales')]
    public function mentionLegale(string $title): Response
    {
        return $this->render('pages/mentionsLegales.html.twig', ['title' => $title, 'description' => 'Page des mentions légales']);
    }

    #[Route('/politiqueConfidentialite', name: 'politiqueConfidentialite')]
    public function politiqueConfidentialite(string $title): Response
    {
        return $this->render('pages/politiqueConfidentialite.html.twig', ['title' => $title, 'description' => 'Page des Politiques de confidentialité']);
    }

}

?>
