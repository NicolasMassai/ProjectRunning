<?php

namespace App\Controller;

use App\Form\BankType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class BankController extends AbstractController
{
   
    private EntityManagerInterface $em;
    private UserRepository $userRepository;

    
    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    #[Route('/bank', name: 'app_bank')]
    public function index(): Response
    {

        $user = $this->userRepository->find($this->getUser());

        return $this->render('bank/index.html.twig', [
            'user' => $user
        ]);
    }

    #[Route('/bank/create', name: 'app_bank_create')]
    public function create(Request $request): Response
    {       
        
        $user = $this->userRepository->find($this->getUser());
        $account = $user->getBank()->getAccount();
        $user->getBank()->setAccount('0');
        $form = $this->createForm(BankType::class, $user->getBank());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
                $user->getBank()->setAccount($user->getBank()->getAccount() + $account);
                $this->em->persist($user);
                $this->em->flush();

                return $this->redirectToRoute('app_bank');
        }
        return $this->render('bank/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
