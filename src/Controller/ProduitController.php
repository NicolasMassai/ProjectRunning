<?php

namespace App\Controller;

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
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProduitController extends AbstractController
{

    
    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    
    #[Route('/produit', name: 'app_produit')]
    public function index(ProduitRepository $produitRepository): Response
    {
        $produit = $produitRepository->findAll();

        return $this->render('produit/index.html.twig', [
            'produits' => $produit
        ]);
    }

    #[Route('/produit/chaussure2', name: 'app_produit_chaussure2')]
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
                'image' => $product->getImage()
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
    #[IsGranted('ROLE_USER')]
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
        $form = $myService->create($request, new Produit, new ProduitType, 
                new ByteString('produit'), new ByteString('produit'));

        return $form;
    }

/*
    #[Route('/produit/buy/{produit}', name: 'app_produit_buy')]
   #[IsGranted("ROLE_USER")]
   public function buy(Produit $produit, ProduitRepository $produitrepository, Request $request, NotifierInterface $notifier): Response
   {
        $id = $produit->getId();
        $produit = $produitrepository->requete($id);

        $user = $this->userRepository->find($this->getUser());
        $account = $user->getBank()->getAccount();
        $prix=($produit[0]->getPrix());
        if ($account<$prix){
            $notifier->send(new Notification('Solde insuffisant', ['browser']));
            return $this->redirectToRoute('app_bank_create');

        }
        else{
        $user->getBank()->setAccount(-$prix);
        $form = $this->createForm(Bank2Type::class, $user->getBank());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $user->getBank()->setAccount($user->getBank()->getAccount() + $account);
                $this->em->persist($user);
                $this->em->flush();

                return $this->redirectToRoute('app_home');
        }

     
        return $this->render('bank/buy.html.twig', [
            'form' => $form->createView()
        ]);
    }
   }
*/
}
