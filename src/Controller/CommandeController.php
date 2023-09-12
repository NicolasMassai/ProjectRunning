<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DetailCommande;
use App\Repository\CommandeRepository;
use App\Repository\DetailCommandeRepository;
use App\Repository\ProduitRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

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
    
 


    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

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
    }

    
    #[Route('/historique', name: 'add')]
    public function historique(SessionInterface $session, CommandeRepository $commanderepository,DetailCommandeRepository $detailCommandeRepository)
    {

        $user = $this->userRepository->find($this->getUser());
        $id = $user->getId();

        $commande = $commanderepository->requete($id);



        /*$commande = $commanderepository->findBy(['user' => 2]);
        $detail = $detailCommandeRepository->findBy(['commande' => 2]);
        */

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
        ]);

    }
      
}