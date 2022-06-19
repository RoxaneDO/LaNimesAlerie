<?php

namespace App\Controller;

use App\Entity\CommandLine;
use App\Entity\Delivery;
use App\Entity\Orders;
use App\Entity\Payment;
use App\Form\OrderPaymentType;
use App\Repository\BasketRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface; // Livré un objet qui représente la sessioninterface
use Symfony\Component\Routing\Annotation\Route;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'basket')]
    public function index(SessionInterface $session, ProductRepository $productRepository): Response
    {
        /* Mettre la session dans un tableau pour l'affichage */
        $panier = $session->get('panier', []); // j'ai un panier qui est égale à ce qu'il y a dans la session qui s'appelle 'panier'

        $panierWithData = []; // Création d'un nouveau tableau avec les informations du produit

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }
        /*AOE Mettre la session dans un tableau pour l'affichage*/


        /* Faire le total */
        $total = 0;
        foreach($panierWithData as $item){
            $totalItem = $item['product']->getPriceHT() * $item['quantity'];
            $total += $totalItem;
        }
        /*AOE faire le total */


        /* dd($panierWithData); */

        return $this->render('basket/index.html.twig', [
            'items' => $panierWithData, 'total' => $total,
        ]);
    }

    #[Route('/basket/add/{id}', name: 'basket_add')]
    public function addBasket($id, SessionInterface $session)
    {

        /* $session = $request->getSession(); // objet de Symfony, n'est plus nécessaire avec sessionInterface*/
        $panier = $session->get('panier', []); // créer un espace mémoire dans la session appelé 'panier', et si je n'ai pas de panier, je veux un tableau vide

        /* Pour la quantité et l'incrémentation */
        if (!empty($panier[$id])){
            $panier[$id]++;
        }
        else {
            $panier[$id] = 1; // id du produit, et de quantité 1
        }
        $session->set('panier', $panier);
        /* AOE quantité et incrémentation */

        /* dd($session->get('panier')); // dump and die */

        return $this->redirectToRoute("basket");

    }

    #[Route('/basket/remove/{id}', name: 'basket_remove')]
    public function remove($id, SessionInterface $session){
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("basket");
    }

    #[Route('/basket/delivery', name: 'basket_delivery')]
    public function deliveryAdress(UserRepository $user){

        if(!empty($this->getUser())){
            $id = $this->getUser()->getId();
            $user = $user->find($id);

            return $this->render('basket/deliveryAdress.html.twig', [
                'user' => $user,
            ]);
        }
        else {
            return $this->redirectToRoute("app_login");
        }
    }

    #[Route('/basket/payment', name: 'basket_payment')]
    public function payement(UserRepository $user, SessionInterface $session, ProductRepository $productRepository, Request $request){

        /* Mettre la session dans un tableau pour l'affichage */
        $panier = $session->get('panier', []); // j'ai un panier qui est égale à ce qu'il y a dans la session qui s'appelle 'panier'

        $panierWithData = []; // Création d'un nouveau tableau avec les informations du produit

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $productRepository->find($id),
                'quantity' => $quantity
            ];
        }
        /*AOE Mettre la session dans un tableau pour l'affichage*/

        /* Formulaire de paiement */
        $order = new Orders();

        $form = $this->createForm(OrderPaymentType::Class, $order);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $order->setDateOrder(new \DateTime('now'));



            // ajoute la clé étrangère user dans la table order
            $user = $this->getUser();
            $order->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($order);
            $entityManager->flush();

            return $this->redirectToRoute('basket_confirmation', [], Response::HTTP_SEE_OTHER);
        }
        /* AOE Formulaire de paiement */

        /* Faire le total */
        $total = 0;
        foreach($panierWithData as $item){
            $totalItem = $item['product']->getPriceHT() * $item['quantity'];
            $total += $totalItem;
        }
        /*AOE faire le total */

        return $this->render('basket/payment.html.twig', [
            'items' => $panierWithData, 'total' => $total, 'form' => $form->createView()
        ]);
    }

    #[Route('/basket/confirmation', name: 'basket_confirmation')]
    public function payment(UserRepository $user, SessionInterface $session, ProductRepository $productRepository, Request $request){

        return $this->render('basket/confirmation.html.twig', [

        ]);
    }
}
