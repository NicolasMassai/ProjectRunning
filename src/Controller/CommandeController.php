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
    {$this->denyAccessUnlessGranted('ROLE_USER');

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
/*
    #[Route('/buy/{commande}', name: 'buy')]
   #[IsGranted("ROLE_USER")]
   public function buy(Commande $commande, CommandeRepository $commanderepository, Request $request, NotifierInterface $notifier): Response
   {
        $id = $commande->getId();
        $commande = $commanderepository->requete3($id);

        var_dump($commande);

        $PrixTotal = 0;

        foreach ($commande as $element) {
        $PrixTotal += $element['total'];
        }
        var_dump($PrixTotal);

        $user = $this->userRepository->find($this->getUser());
        $account = $user->getBank()->getAccount();
        //$prix=($commande[0]->getPrix());
        //dd($prix);
        if ($account<$PrixTotal){
            $notifier->send(new Notification('Solde insuffisant', ['browser']));
            return $this->redirectToRoute('app_bank_create');

        }
        else{
        $user->getBank()->setAccount(-$PrixTotal);
        $form = $this->createForm(Bank2Type::class, $user->getBank());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $user->getBank()->setAccount($user->getBank()->getAccount() + $account);
                $this->em->persist($user);
                $this->em->flush();

                return $this->redirectToRoute('app_commande_add');
        }

     
        return $this->render('bank/buy.html.twig', [
            'form' => $form->createView()
        ]);
    }
   }
*/
    
    #[Route('/historique', name: 'historique')]
    public function historique(CommandeRepository $commanderepository)
    {

        $user = $this->userRepository->find($this->getUser());
        $id = $user->getId();

        $commande = $commanderepository->requete($id);

        return $this->render('commande/index.html.twig', [
            'commandes' => $commande,
        ]);

    }
      
}