<?php

namespace App\Controller;

use App\Service\Service;
use App\Entity\CategorieProduit;
use App\Form\CategorieProduitType;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategorieProduitController extends AbstractController
{
    #[Route('/categorie_produit', name: 'app_categorie_produit')]
    #[IsGranted('ROLE_USER')]
    public function index(CategorieProduitRepository $categorieProduitRepository): Response
    {
        $categorie = $categorieProduitRepository->findAll();

        return $this->render('categorie_produit/index.html.twig', [
            'categories' => $categorie
        ]);
    }
    


    #[Route('/categorie_produit/create', name: 'app_categorie_produit_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Service $myService, Request $request): Response

    {
        $form = $myService->create($request, new CategorieProduit, new CategorieProduitType, 
                new ByteString('categorie_produit'), new ByteString('categorie_produit'));

        return $form;
    }


}
