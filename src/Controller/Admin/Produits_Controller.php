<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Service\Service;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin', name: 'app_admin_')]
#[IsGranted('ROLE_ADMIN')]
class Produits_Controller extends AbstractController
{


    private EntityManagerInterface $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    #[Route('/produit', name: 'produit')]
    public function produit(): Response
    {
        return $this->render('admin/produit.html.twig');
    }


    #[Route('/produit/JSON', name: 'produit2')]
    public function produit2(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findAll();


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


    #[Route('/produit/create', name: 'produit_create')]
    public function create(Service $myService, Request $request): Response
    {
        $form = $myService->create(
            $request,
            new Produit,
            new ProduitType,
            new ByteString('admin_produit'),
            new ByteString('admin'),
            new ByteString('produit')
        );

        return $form;
    }

    #[Route('/produit/update/{produit}', name: 'produit_update')]
    public function update(Service $myService, Produit $produit, Request $request): Response
    {

        $form = $myService->update(
            $request,
            new ProduitType,
            $produit,
            new ByteString('admin_produit'),
            new ByteString('admin'),
            new ByteString('produit')
        );

        return $form;

    }

    #[Route('/produit/delete/{produit}', name: 'produit_delete')]
    public function delete(Produit $produit): Response

    {
        if ($produit) {
            foreach($produit->getDetailCommandes() as $detail){
            $this->em->remove($detail);
        
        }
        
        $this->em->remove($produit);
        $this->em->flush();

        return $this->redirectToRoute("app_admin_produit");
        }
}   
}
