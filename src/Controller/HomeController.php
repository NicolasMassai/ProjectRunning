<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    private UserRepository $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
       
        return $this->render('home/index.html.twig', [
            'user' => 'user'
        ]);
    }
}
