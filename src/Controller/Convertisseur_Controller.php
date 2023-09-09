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
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Convertisseur_Controller extends AbstractController
{

    private EntityManagerInterface $em;
    private ConvertisseurRepository $convertRepository;

    
    public function __construct(ConvertisseurRepository $convertRepository, EntityManagerInterface $em)
    {
        $this->convertRepository = $convertRepository;
        $this->em = $em;
    }


    #[Route('/convertisseur/menu', name: 'app_convertisseur_menu')]
    public function affichage(): Response
    {

        return $this->render('convertisseur_menu/index.html.twig', [
            'convertisseur' => 'affichage',
        ]);

       
    }

    #[Route('/convertisseur', name: 'app_convertisseur')]
    public function convert(Request $request, Service $service): Response
    {

        $c = new Convertisseur();
        $form = $this->createForm(ConvertisseurAllureToVitesseType::class, $c);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $running = $form->get('allure')->getData();    
            $nombre = $service->convertisseurAllureToVitesse($running);
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


#[Route('/convertisseur3', name: 'app_convertisseur3')]
    public function calculVitesseetAllure(Request $request, Service $service): Response
    {

    $c = new Convertisseur();
    $form = $this->createForm(CalculVitesseEtAllureType::class, $c);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $distance = $form->get('distance')->getData(); 
        $temps = $form->get('temps')->getData(); 


        $totalHeure = $service->convertisseurTempstoDecimal($temps);

                
        // Calcul de la vitesse en km/h
        $vitessetemp = $distance / $totalHeure;
        $vitesse = round($vitessetemp, 2);


        // Calcul de l'allure en min/km
        $allure = $service->convertisseurVitessetoAllure($vitessetemp);


        $this->em->persist($c);
        $this->em->flush();
        
        return $this->render('convertisseur3/resultat.html.twig', [
            'distance' => $distance,
            'temps' => $temps,
            'vitesse' => $vitesse,
            'allure' => $allure,
        ]);
    }

    return $this->render('convertisseur3/index.html.twig', [
        'form' => $form->createView(),
    ]);

}
    #[Route('/convertisseur4', name: 'app_convertisseur4')]
    public function calculTempsetAllure(Request $request, Service $service): Response
    {

    $c = new Convertisseur();
    $form = $this->createForm(CalculTempsEtAllureType::class, $c);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $distance = $form->get('distance')->getData(); 
        $vitesse = $form->get('vitesse')->getData(); 


        $tempstemp = $distance/$vitesse;
        

        $temps = $service->convertisseurTempsenHMS($tempstemp);

        $allure = $service->convertisseurVitessetoAllure($vitesse);


        $this->em->persist($c);
        $this->em->flush();
        
        return $this->render('convertisseur4/resultat.html.twig', [
            'distance' => $distance,
            'temps' => $temps,
            'vitesse' => $vitesse,
            'allure' => $allure,
        ]);
    }

    return $this->render('convertisseur4/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route('/convertisseur5', name: 'app_convertisseur5')]
    public function calculTempsEtVitesse(Request $request, Service $service): Response
    {

    $c = new Convertisseur();
    $form = $this->createForm(CalculTempsEtVitesseType::class, $c);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $distance = $form->get('distance')->getData(); 
        $allure = $form->get('allure')->getData();
        
        $alluredecimal = $service->convertisseurAlluretoDecimal($allure);

        $tempstemp = ($distance * $alluredecimal / 60);

        $vitessetemp = $distance/$tempstemp;

        $temps = $service->convertisseurTempsenHMS($tempstemp);

        $vitesse = round($vitessetemp, 2,PHP_ROUND_HALF_UP);
   

        $this->em->persist($c);
        $this->em->flush();
        
        return $this->render('convertisseur5/resultat.html.twig', [
            'distance' => $distance,
            'temps' => $temps,
            'vitesse' => $vitesse,
            'allure' => $allure,
        ]);
    }

    return $this->render('convertisseur5/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route('/convertisseur6', name: 'app_convertisseur6')]
    public function calculDistanceEtVitesse(Request $request, Service $service): Response
    {

    $c = new Convertisseur();
    $form = $this->createForm(CalculDistanceEtVitesseType::class, $c);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $temps = $form->get('temps')->getData(); 
        $allure = $form->get('allure')->getData(); 

        $alluredecimal = $service->convertisseurAlluretoDecimal($allure);

        $tempsdecimal = $service->convertisseurTempstoDecimal($temps);

        list($heures, $minutes, $secondes) = explode(":", $temps);

        $nombreDeMinutes = ($heures * 60) + $minutes + ($secondes / 60);

        
        // Calcul de la distance en kilomètres
        $distancetemp = ($nombreDeMinutes / $alluredecimal);
        $distance = round($distancetemp, 2,PHP_ROUND_HALF_UP);


        // Calcul de la vitesse en km/h
        $vitessetemp = $distance / $tempsdecimal;

        $vitesse = round($vitessetemp, 2,PHP_ROUND_HALF_UP);

   

        $this->em->persist($c);
        $this->em->flush();
        
        return $this->render('convertisseur6/resultat.html.twig', [
            'distance' => $distance,
            'temps' => $temps,
            'vitesse' => $vitesse,
            'allure' => $allure,
        ]);
    }

    return $this->render('convertisseur6/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route('/convertisseur7', name: 'app_convertisseur7')]
    public function calculDistanceEtAllure(Request $request, Service $service): Response
    {

    $c = new Convertisseur();
    $form = $this->createForm(CalculDistanceEtAllureType::class, $c);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

        $temps = $form->get('temps')->getData(); 
        $vitesse = $form->get('vitesse')->getData(); 

        $tempsdecimal = $service->convertisseurTempstoDecimal($temps);

        
        // Calcul de la distance en kilomètres
        $distancetemp = ($tempsdecimal * $vitesse);
        $distance = round($distancetemp, 2,PHP_ROUND_HALF_UP);


        // Calcul de l'allure en min/km
        //$allure = ($tempsdecimal * 60) / $distance;
        $allure = $service->convertisseurVitessetoAllure($vitesse);

   

        $this->em->persist($c);
        $this->em->flush();
        
        return $this->render('convertisseur7/resultat.html.twig', [
            'distance' => $distance,
            'temps' => $temps,
            'vitesse' => $vitesse,
            'allure' => $allure,
        ]);
    }

    return $this->render('convertisseur7/index.html.twig', [
        'form' => $form->createView(),
    ]);
}



}
