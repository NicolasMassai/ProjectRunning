<?php
namespace App\Service;

use App\Entity\Matchs;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Form\MatchsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\String\ByteString;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Service extends AbstractController
{   
    private EntityManagerInterface $em;

    

    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;        

    }
   
    
    public function create(Request $request,$Class, $ClassType, $string ,$string2 ): Response
    {
        $var = new $Class();
        $form = $this->createForm($ClassType::class, $var);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($var);
            $this->em->flush();
            return $this->redirectToRoute('app_'.$string.'');
        }

        return $this->render(''.$string2.'/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function convertisseurAllureToVitesse($pace)
    {
        list($minutes, $seconds) = explode(':', $pace);

        // Convertissez le temps en secondes
        $totalSeconds = ($minutes * 60) + $seconds;

        // Calcul de la vitesse en mètres par seconde (m/s)
        $distanceInMeters = 1000; // Par exemple, si le pace est en kilomètres
        $speedInMetersPerSecond = $distanceInMeters / $totalSeconds;
        $speedInKiloMeterPerHeure = $speedInMetersPerSecond * 3.6;

        return $speedInKiloMeterPerHeure;
    }

    public function convertisseurVitessetoAllure($vitesseKmH)
    {

        $allure = 60 / $vitesseKmH;       


        if (strpos($allure, '.') === false) {

            $allurefinal = implode(":",[$allure, 0]);

            return $allurefinal;    
        
        }
        else{

            // Convertie la vitesse en allure en min/km
            list($minutes, $seconds) = explode('.', $allure);

            $allureMinKm = implode(".",[0 , ($seconds)]);

            // Arrondie les seconde à l'unité
            $seconde = round($allureMinKm *60,0,PHP_ROUND_HALF_UP);

            //list($seconde) = explode('.', $a);
            $allureMinKm2 = implode(":",[$minutes , $seconde]);
            
            return $allureMinKm2;
        }
    }

    public function convertisseurTempsenHMS($temps)
    {

        if (strpos($temps, '.') === false) {

            return $temps;    
        
        }
        else{

            list($heures, $minutestemp) = explode('.', $temps);

            $calculeminutetemp = implode(".",[0 , ($minutestemp)]);

            $calculeminute = $calculeminutetemp *60;

            if (strpos($calculeminute, '.') === false) {

                $heurefinal = implode(":",[$heures, $calculeminute  , 0]);
    
                return $heurefinal; 
            
            }
            else{

                list($minutes, $secondetemp) = explode('.', $calculeminute);

                $calculesecondetemp = implode(".",[0 , ($secondetemp)]);

                $calculeseconde = $calculesecondetemp * 60;

                list($secondes) = explode('.', $calculeseconde);

                $heurefinal = implode(":",[$heures, $minutes , $secondes]);

                return $heurefinal;
            }
        }

    }

    public function convertisseurAlluretoDecimal($allure)

    {

        list($minutes, $seconds) = explode(':', $allure);

        $secondetemp =  ($seconds / 0.6);
        
        $secondes = round($secondetemp, 0,PHP_ROUND_HALF_UP);

        $totalallure = implode(".",[$minutes , $secondes]);

        return $totalallure;
    }

    public function convertisseurTempstoDecimal($temps)

    {

        list($heures ,$minutes, $seconds) = explode(':', $temps);  
        $totalHeure = $heures + ($minutes / 60) + ($seconds /3600);

        return $totalHeure;
    
    }

 /*
    public function ajouterProduit(Panier $panier, Produit $produit)
    {
        $panierProduits = $panier->getProduit();

        // Vérifiez si le produit est déjà dans le panier
        foreach ($panierProduits as $panierProduit) {
            if ($panierProduit->getId() === $produit->getId()) {
                // Mettez à jour la quantité du produit dans le panier
                $panierProduit->setQuantite($panierProduit->getQuantite() + 1);

                // Persister et flusher l'entité Panier
                $this->em->persist($panier);
                $this->em->flush();

                return;
            }
        }

        // Si le produit n'est pas encore dans le panier, ajoutez-le
        $panierProduit = new Produit();
        $panierProduit->setQuantite(1);
        $panierProduit->setPanier($panier);

        $panier->addProduit($panierProduit);

        // Persister et flusher l'entité Panier
        $this->em->persist($panier);
        $this->em->flush();
       
    }

    public function supprimerProduit(Produit $produit)
    {
        $panier = $this->session->get('panier', []);

        // Supprimer le produit du panier (par exemple, en utilisant l'ID du produit comme clé)
        $produitId = $produit->getId();
        if (isset($panier[$produitId]) && $panier[$produitId] > 0) {
            $panier[$produitId]--;
        }

        // Enregistrer le panier dans la session
        $this->session->set('panier', $panier);
    }

    public function viderPanier()
    {
        // Vider le panier en supprimant la clé 'panier' de la session
        $this->session->remove('panier');
    }

   

    public function getTotalPanier()
    {
        $panier = $this->getContenuPanier();
        $total = 0;

        // Vous devez implémenter la logique pour calculer le total en fonction des prix des produits

        return $total;
    }*/
}