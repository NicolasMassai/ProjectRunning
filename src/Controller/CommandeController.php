<?php

namespace App\Controller;

use App\Form\Bank2Type;
use App\Entity\Commande;
use PHPUnit\TextUI\Command;
use App\Entity\DetailCommande;
use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\DetailCommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
#[Route('/commandes', name: 'app_commandes_')]
class CommandeController extends AbstractController
{

    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    
    #[Route('/historique', name: 'historique')]
    public function montre(): Response
    {
        
        return $this->render('commande/commande.html.twig', [
        ]);
    }

    #[Route('/historique2', name: 'historique2')]
    public function historique(CommandeRepository $commanderepository)
    {

        $user = $this->userRepository->find($this->getUser());
        $id = $user->getId();

        $commande = $commanderepository->requete($id);

        return  $this->json($commande, 200);


        /*
        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
        ]);*/

    }
/*
    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepository): Response
    {

        $panier = $session->get('panier', []);

        if($panier === []){
            
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('app_home');
        }

        //Le panier n'est pas vide, on crée la commande
        $commande = new Commande();

        // On remplit la commande
        $commande->setUser($this->getUser());
        $commande->setReference(uniqid());

        // On parcourt le panier pour créer les détails de commande
        foreach($panier as $item => $quantity){
            $commandeDetails = new DetailCommande();

            // On va chercher le produit
            $product = $produitRepository->find($item);
            
            $price = $product->getPrix();

            // On crée le détail de commande
            $commandeDetails->setProduit($product);
            $commandeDetails->setPrix($price);
            $commandeDetails->setQuantite($quantity);

            $commande->addDetailCommande($commandeDetails);
        }

        // On persiste et on flush
        $this->em->persist($commande);
        $this->em->flush();

        $session->remove('panier');

        $this->addFlash('message', 'Commande créée avec succès');
        return $this->redirectToRoute('app_home');
    }*/

      
}