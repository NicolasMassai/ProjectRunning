<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Produit;
use App\Form\Bank2Type;
use App\Service\Service;
use App\Form\ProduitType;
use App\Entity\CategorieProduit;
use App\Form\CategorieProduitType;
use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[IsGranted('ROLE_USER')]
class Produit_Controller extends AbstractController
{


    private EntityManagerInterface $em;
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    #[Route('/produit/chaussure2', name: 'app_produit_chaussure2')]
    public function chaussure2(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findBy(['categorie' => 1]);

        $user = $this->userRepository->find($this->getUser());

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
                'role' => current($user->getRoles())
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



    #[Route('/produit/montre2', name: 'app_produit_montre2')]
    public function montre2(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findBy(['categorie' => 2]);

        $user = $this->userRepository->find($this->getUser());

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
                'role' => current($user->getRoles())
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


    #[Route('/produit/find/{produit}', name: 'app_produit_id')]
    public function getId(Produit $produit, ProduitRepository $produitrepository): Response
    {

        $id = $produit->getId();

        $produit = $produitrepository->requete($id);


        return $this->render('produit/getId.html.twig', [
            'produits' => $produit
        ]);
    }



    #[Route('/produit/create', name: 'app_produit_create')]
    #[IsGranted('ROLE_ADMIN')]
    public function create(Service $myService, Request $request): Response
    {
        $form = $myService->create(
            $request,
            new Produit,
            new ProduitType,
            new ByteString('home'),
            new ByteString('produit')
        );

        return $form;
    }

    #[Route('/produit/update/{produit}', name: 'app_produit_update')]
    #[IsGranted("ROLE_ADMIN")]
    public function update(Produit $produit, Request $request): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($produit);
            $this->em->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('produit/update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/produit/delete/{produit}', name: 'app_produit_delete')]
    #[IsGranted("ROLE_ADMIN")]
    public function delete(Produit $produit, Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {

            $this->em->remove($produit);
            $this->em->flush();
        
        return $this->redirectToRoute("app_home");
    }
}
