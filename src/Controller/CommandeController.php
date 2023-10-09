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
#[IsGranted('ROLE_USER')]
class CommandeController extends AbstractController
{

    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    
    #[Route('/historique', name: 'historique')]
    public function montre(): Response
    {
        
        return $this->render('commande/commande.html.twig', [
        ]);
    }

    #[Route('/historique/JSON', name: 'historique2')]
    public function historique(CommandeRepository $commanderepository)
    {

        $user = $this->userRepository->find($this->getUser());
        $id = $user->getId();

        $commande = $commanderepository->requete($id);

        return  $this->json($commande, 200);


    }
      
}