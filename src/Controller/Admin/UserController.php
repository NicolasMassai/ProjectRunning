<?php

namespace App\Controller\Admin;

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


#[Route('/admin', name: 'app_admin_')]
#[IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
    private EntityManagerInterface $em;


    public function __construct(EntityManagerInterface $em)
    {
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
    public function update(Service $myService, User $user, Request $request): Response
    {

        $form = $myService->update(
            $request,
            new UserType,
            $user,
            new ByteString('admin_users'),
            new ByteString('admin'),
            new ByteString('user')
        );

        return $form;
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