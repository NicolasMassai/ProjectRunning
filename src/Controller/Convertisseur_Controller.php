<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Convertisseur_Controller extends AbstractController
{


    #[Route('/convertisseur', name: 'app_convertisseur')]
    public function affichage(): Response
    {
        return $this->render('convertisseur/index.html.twig', [
        ]);
 
    }

}
