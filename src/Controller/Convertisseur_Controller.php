<?php

namespace App\Controller;

use App\Service\Service;
use App\Entity\Convertisseur;
use App\Form\CalculTempsEtAllureType;
use App\Form\CalculTempsEtVitesseType;
use App\Form\CalculVitesseEtAllureType;
use App\Form\CalculDistanceEtAllureType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use App\Form\CalculDistanceEtVitesseType;
use App\Repository\ConvertisseurRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ConvertisseurAllureToVitesseType;
use App\Form\ConvertisseurVitesseToAllureType;
use PhpParser\Builder\Class_;
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
