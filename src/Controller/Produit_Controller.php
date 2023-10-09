<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class Produit_Controller extends AbstractController
{


    private EntityManagerInterface $em;
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    
    #[Route('/produit/chaussure/JSON', name: 'app_produit_chaussure2')]
    public function chaussure2(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findBy(['categorie' => 1]);


        $produits = [];
        foreach ($produit as $product) {
            $produits[] = [
                'id' => $product->getId(),
                'nom' => $product->getNom(),
                'description' => $product->getDescription(),
                'prix' => $product->getPrix(),
                'couleur' => $product->getCouleur(),
                'taille' => $product->getTaille(),
                'quantite' => $product->getQuantite(),
                'image' => $product->getImage(),
            ];
        }
        return $this->json($produits, 200);
    }

    #[Route('/produit/chaussure', name: 'app_produit_chaussure')]
    public function chaussure(): Response
    {

        return $this->render('produit/chaussure.html.twig', [
            'produits' => 'produit'
        ]);
    }



    #[Route('/produit/montre/JSON', name: 'app_produit_montre2')]
    public function montre2(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findBy(['categorie' => 2]);


        $produits = [];
        foreach ($produit as $product) {
            $produits[] = [
                'id' => $product->getId(),
                'nom' => $product->getNom(),
                'description' => $product->getDescription(),
                'prix' => $product->getPrix(),
                'couleur' => $product->getCouleur(),
                'taille' => $product->getTaille(),
                'quantite' => $product->getQuantite(),
                'image' => $product->getImage(),
            ];
        }
        return $this->json($produits, 200);
    }

    #[Route('/produit/montre', name: 'app_produit_montre')]
    public function montre(): Response
    {

        return $this->render('produit/montre.html.twig', [
            'produits' => 'produit'
        ]);
    }

}
