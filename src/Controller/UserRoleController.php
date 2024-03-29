<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Service\Service;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
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
    public function index(): Response
    {

        return $this->render('user/index.html.twig');
    }


    #[Route('/compte/JSON', name: 'app_compte2')]

    public function indexJSON(): Response
    {

        $user = $this->userRepository->find($this->getUser());

        $users = [];

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
    public function update(Service $myService, User $user, Request $request): Response
    {

        $form = $myService->update(
            $request,
            new UserType,
            $user,
            new ByteString('compte'),
            new ByteString('user'),
            new ByteString('user')
        );

        return $form;
    }
}
