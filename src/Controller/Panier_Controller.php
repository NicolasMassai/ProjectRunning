<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\Bank2Type;
use App\Entity\Commande;
use App\Service\Service;
use App\Entity\DetailCommande;
use App\Repository\UserRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/panier', name: 'app_panier_')]
#[IsGranted('ROLE_USER')]
class Panier_Controller extends AbstractController
{


    private EntityManagerInterface $em;
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    #[Route('/', name: 'index')]
    public function montre(): Response
    {

        return $this->render('panier/panier.html.twig', []);
    }

    #[Route('/2', name: 'index2')]
    public function index(SessionInterface $session, ProduitRepository $produitrepository)
    {
        $panier = $session->get('panier', []);

        $data = [];

        foreach ($panier as $id => $quantity) {
            $produit = $produitrepository->find($id);

            $data[] = [
                'id' => $produit->getId(),
                'nom' => $produit->getNom(),
                'prix' => $produit->getPrix(),
                'quantity' => $quantity,
                'quantityTotal' => $produit->getQuantite(),
                'image' => $produit->getImage()
            ];
        }

        return  $this->json($data, 200);


    }


    #[Route('/add/{id}', name: 'add')]
    public function add(SessionInterface $session, Produit $produit)
    {

        $id = $produit->getId();
        $panier = $session->get('panier', []);

        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session)
    {
        $id = $produit->getId();

        // On récupère le panier existant
        $panier = $session->get('panier', []);

        // On retire le produit du panier s'il n'y a qu'1 exemplaire
        // Sinon on le décrémente
        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session)
    {
        $id = $produit->getId();

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
    {
        $session->remove('panier');

        return $this->redirectToRoute('app_panier_index');
    }

    #[Route('/buy', name: 'buy')]
    public function buy(SessionInterface $session, ProduitRepository $produitrepository, Request $request, NotifierInterface $notifier)
    {
        $panier = $session->get('panier', []);

        $data = [];
        $total = 0;

        foreach ($panier as $id => $quantity) {
            $produit = $produitrepository->find($id);

            $data[] = [
                'produit' => $produit,
                'quantity' => $quantity
            ];
            $total += $produit->getPrix() * $quantity;

            $produitQuantite = $produit->setQuantite(($produit->getQuantite() - $quantity));

            if ($produitQuantite->getQuantite() < 0) {
                
                $session->remove('panier');
                $this->addFlash('message', 'plus de stock');
                return $this->redirectToRoute('app_home');
            }
        }
        


        $user = $this->userRepository->find($this->getUser());
        $account = $user->getBank()->getAccount();
        if ($account < $total) {
            $notifier->send(new Notification('Solde insuffisant', ['browser']));
            return $this->redirectToRoute('app_bank_create');
        } else {
            $user->getBank()->setAccount(-$total);
            $form = $this->createForm(Bank2Type::class, $user->getBank());
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user->getBank()->setAccount($user->getBank()->getAccount() + $account);
                $this->em->persist($produitQuantite);
                $this->em->persist($user);
                $this->em->flush();

                //On crée la commande
                $commande = new Commande();

                // On remplit la commande
                $commande->setUser($this->getUser());
                $commande->setReference(uniqid());

                // On créer les détails de commande
                foreach ($panier as $item => $quantity) {
                    $commandeDetails = new DetailCommande();

                    // On récupère le produit
                    $product = $produitrepository->find($item);

                    $price = $product->getPrix();

                    $commandeDetails->setProduit($product);
                    $commandeDetails->setPrix($price);
                    $commandeDetails->setQuantite($quantity);

                    $commande->addDetailCommande($commandeDetails);
                }

                $this->em->persist($commande);
                $this->em->flush();

                $session->remove('panier');

                $this->addFlash('message', 'Commande créée avec succès');
                return $this->redirectToRoute('app_home');
            }


            return $this->render('bank/buy.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
}
