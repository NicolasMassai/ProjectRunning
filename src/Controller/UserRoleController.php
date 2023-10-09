<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class UserRoleController extends AbstractController
{
    private EntityManagerInterface $em;
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }
    
    
    #[Route('/compte', name: 'app_compte')]
    public function index1(): Response
    {

        return $this->render('user/index.html.twig');
    }

    
    #[Route('/compte/JSON', name: 'app_compte2')]

    public function index2(): Response
    {

        $user = $this->userRepository->find($this->getUser());

        $users=[];

            $users[] = [
            'id' => $user->getId(),
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'adresse' => $user->getAdresse(),
            'role' => current($user->getRoles())
            
        ];
    
        return $this->json($users, 200);
    }

    #[Route('/compte/update/{user}', name: 'app_compte_update')]
    public function update(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('app_compte');
        }
        return $this->render('user/update.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
