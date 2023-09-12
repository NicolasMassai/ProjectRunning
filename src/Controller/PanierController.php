<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Produit;
use App\Form\Bank2Type;
use App\Service\Service;
use App\Repository\UserRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  
#[Route('/panier', name: 'app_panier_')]
class PanierController extends AbstractController
{


    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitrepository)
    {
        $panier = $session->get('panier', []);

        // On initialise des variables
        $data = [];
        $total = 0;

        foreach($panier as $id => $quantity){
            $produit = $produitrepository->find($id);

            $data[] = [
                'produit' => $produit,
                'quantity' => $quantity
            ];
            $total += $produit->getPrix() * $quantity;
        }


        return $this->render('panier/index.html.twig', compact('data', 'total'));
    
        
    }


    #[Route('/add/{id}', name: 'add')]
    public function add(SessionInterface $session, Produit $produit)
    {

        $id = $produit->getId();

        $panier = $session->get('panier', []);

    if(empty($panier[$id])){
        $panier[$id] = 1;}
        else{
            $panier[$id]++;
        }
    
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session)
    {
        //On récupère l'id du produit
        $id = $produit->getId();

        // On récupère le panier existant
        $panier = $session->get('panier', []);

        // On retire le produit du panier s'il n'y a qu'1 exemplaire
        // Sinon on décrémente sa quantité
        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);
        
        //On redirige vers la page du panier
        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session)
    {
        //On récupère l'id du produit
        $id = $produit->getId();

        // On récupère le panier existant
        $panier = $session->get('panier', []);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
        
        //On redirige vers la page du panier
        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/buy', name: 'buy')]
    public function buy(SessionInterface $session, ProduitRepository $produitrepository,Request $request, NotifierInterface $notifier)
    {
        $panier = $session->get('panier', []);

        // On initialise des variables
        $data = [];
        $total = 0;

        foreach($panier as $id => $quantity){
            $produit = $produitrepository->find($id);

            $data[] = [
                'produit' => $produit,
                'quantity' => $quantity
            ];
            $total += $produit->getPrix() * $quantity;
        }


        $user = $this->userRepository->find($this->getUser());
        $account = $user->getBank()->getAccount();
        if ($account<$total){
            $notifier->send(new Notification('Solde insuffisant', ['browser']));
            return $this->redirectToRoute('app_bank_create');

        }
        else{
        $user->getBank()->setAccount(-$total);
        $form = $this->createForm(Bank2Type::class, $user->getBank());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $user->getBank()->setAccount($user->getBank()->getAccount() + $account);
                $this->em->persist($user);
                $this->em->flush();

                return $this->redirectToRoute('app_commandes_add');
        }

     
        return $this->render('bank/buy.html.twig', [
            'form' => $form->createView()
        ]);
    }    
    }

   
}