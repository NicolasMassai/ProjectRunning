<?php

namespace App\Controller;


use App\Repository\UserRepository;
use App\Repository\CommandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commandes', name: 'app_commandes_')]
#[IsGranted('ROLE_USER')]
class CommandeController extends AbstractController
{

    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    #[Route('/historique', name: 'historique')]
    public function index(): Response
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