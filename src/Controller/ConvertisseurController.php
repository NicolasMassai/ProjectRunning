<?php

namespace App\Controller;

use App\Service\Service;
use App\Entity\Convertisseur;
use App\Form\ConvertisseurType;
use App\Repository\ConvertisseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConvertisseurController extends AbstractController
{

    private EntityManagerInterface $em;
    private ConvertisseurRepository $convertRepository;

    
    public function __construct(ConvertisseurRepository $convertRepository, EntityManagerInterface $em)
    {
        $this->convertRepository = $convertRepository;
        $this->em = $em;
    }    
    #[Route('/convertisseur', name: 'app_convertisseur')]
    public function convert(Request $request, Service $service): Response
    {

        $c = new Convertisseur();
        $form = $this->createForm(ConvertisseurType::class, $c);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $running = $form->get('allure')->getData();    
            $speedInMetersPerSecond = $service->convertisseur2($running);
            
            $this->em->persist($c);
            $this->em->flush();
            
            return $this->render('convertisseur/resultat.html.twig', [
                'allure' => $running,
                'temps' => $speedInMetersPerSecond,
            ]);
        }

        return $this->render('convertisseur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /*
    public function convertisseur(Service $myService, Request $request): Response

    {
        $form = $myService->convertisseur($request, new Convertisseur, new ConvertisseurType, new ByteString('convertisseur'), new ByteString('convertisseur'));

        return $form;
    }
    */
}
