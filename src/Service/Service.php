<?php
namespace App\Service;

use App\Entity\Matchs;
use App\Form\MatchsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Service extends AbstractController


{   private EntityManagerInterface $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
   
    
    public function convertisseur(Request $request,$Class, $ClassType, $string ,$string2 ): Response
    {
        $var = new $Class();
        $form = $this->createForm($ClassType::class, $var);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($var);
            $this->em->flush();
            return $this->redirectToRoute('app_'.$string.'');
        }

        return $this->render(''.$string2.'/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function convertisseur2($pace)
    {
        // Assurez-vous que $pace est au format "hh:mm:ss" (heures:minutes:secondes)
        list($hours, $minutes, $seconds) = explode(':', $pace);

        // Convertissez le temps en secondes
        $totalSeconds = ($hours * 3600) + ($minutes * 60) + $seconds;

        // Calcul de la vitesse en mètres par seconde (m/s)
        $distanceInMeters = 1000; // Par exemple, si le pace est en kilomètres
        $speedInMetersPerSecond = $distanceInMeters / $totalSeconds;
        $speedInKiloMeterPerHeure = $speedInMetersPerSecond * 3.6;

        return $speedInKiloMeterPerHeure;
    }

}