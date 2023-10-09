<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\ProduitType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/admin', name: 'app_admin_')]
#[IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
    private EntityManagerInterface $em;
    private UserRepository $userRepository;


    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }


    #[Route('/utilisateurs', name: 'users')]
    public function index(): Response
    {
        return $this->render('admin/user.html.twig', [
        ]);
        
    }


    #[Route('/utilisateurs/JSON', name: 'users2')]
    public function index2(UserRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();

        $userData = [];
        foreach ($users as $user) {
            $userData[] = [
                'id' => $user->getId(),
                'nom' => $user->getNom(),
                'prenom' =>$user->getPrenom(),
                'adresse'=>$user->getAdresse(),
                'email'=>$user->getEmail(),
                'roles' =>current($user->getRoles())
            ];
        }


        return $this->json($userData, 200);
    }

  

    #[Route('/utilisateurs/update/{user}', name: 'users_update')]
    public function update(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('app_admin_users');
        }
        return $this->render('admin/user_update.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/utilisateurs/delete/{utilisateurs}', name: 'users_delete')]
    public function delete(User $utilisateurs): Response
    {
     
        if ($utilisateurs) {
            foreach ($utilisateurs->getCommandes() as $commande) {
                foreach($commande->getDetailCommandes() as $detail){
                $this->em->remove($commande);
                $this->em->remove($detail);
            }}

                $this->em->remove($utilisateurs);
                $this->em->flush();
            
            return $this->redirectToRoute("app_admin_users");
            
    
        }
    }

}