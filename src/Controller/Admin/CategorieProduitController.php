<?php

namespace App\Controller\Admin;

use App\Service\Service;
use App\Entity\CategorieProduit;
use App\Form\CategorieProduitType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\CategorieProduitRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin', name: 'app_admin_')]
#[IsGranted('ROLE_ADMIN')]
class CategorieProduitController extends AbstractController
{


    private EntityManagerInterface $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/categorie_produit', name: 'categorie_produit')]
    public function index(): Response
    {
        return $this->render('admin/categorie.html.twig', []);
    }


    #[Route('/categorie_produit/JSON', name: 'categorie_produit2')]
    public function indexJSON(CategorieProduitRepository $categorieProduitRepository): Response
    {
        $categorie = $categorieProduitRepository->findAll();


        $categories = [];
        foreach ($categorie as $product) {
            $categories[] = [
                'id' => $product->getId(),
                'nom' => $product->getName(),

            ];
        }
        return $this->json($categories, 200);
    }



    #[Route('/categorie_produit/create', name: 'categorie_produit_create')]
    public function create(Service $myService, Request $request): Response

    {
        $form = $myService->create(
            $request,
            new CategorieProduit,
            new CategorieProduitType,
            new ByteString('admin_categorie_produit'),
            new ByteString('admin'),
            new ByteString('categorie')
        );

        return $form;
    }

    #[Route('/categorie_produit/update/{categorie_produit}', name: 'categorie_produit_update')]
    public function update(Service $myService, CategorieProduit $categorie_produit, Request $request): Response
    {
        $form = $myService->update(
            $request,
            new CategorieProduitType,
            $categorie_produit,
            new ByteString('admin_categorie_produit'),
            new ByteString('admin'),
            new ByteString('categorie')
        );

        return $form;
    }

    #[Route('/categorie_produit/delete/{categorie_produit}', name: 'categorie_produit_delete')]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(CategorieProduit $categorie_produit): Response
    {

        $this->em->remove($categorie_produit);
        $this->em->flush();

        return $this->redirectToRoute("app_admin_categorie_produit");
    }
}
