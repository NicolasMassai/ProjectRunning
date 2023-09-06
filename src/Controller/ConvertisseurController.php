<?php

namespace App\Controller;

use App\Service\Service;
use App\Entity\Convertisseur;
use App\Form\ConvertisseurType;
use App\Form\ConvertisseurVitesseToAllureType;
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
            $nombre = $service->convertisseur2($running);
            $speedInKilometerperHour = round($nombre, 2);
            
            $this->em->persist($c);
            $this->em->flush();
            
            return $this->render('convertisseur/resultat.html.twig', [
                'allure' => $running,
                'temps' => $speedInKilometerperHour,
            ]);
        }

        return $this->render('convertisseur/index.html.twig', [
            'form' => $form->createView(),
        ]);

       
    }

    #[Route('/convertisseur2', name: 'app_convertisseur2')]
    public function convertVitesseToAllure(Request $request, Service $service): Response
    {

    $c = new Convertisseur();
    $form = $this->createForm(ConvertisseurVitesseToAllureType::class, $c);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $running = $form->get('vitesse')->getData();    
        $nombre = $service->convertisseurVitessetoAllure($running);
        
        $this->em->persist($c);
        $this->em->flush();
        
        return $this->render('convertisseur2/resultat.html.twig', [
            'temps' => $running,
            'allure' => $nombre,
        ]);
    }

    return $this->render('convertisseur2/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

}
