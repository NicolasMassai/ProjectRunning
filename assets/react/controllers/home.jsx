import React, { useState, useEffect } from 'react';
import image from './chaussure1.jpg'
import userphoto from './photo/utilisateur.png'
import runsport from './photo/runsport.jpg'
import accueilImage from './photo/accueil.jpg'


export default function panier(props) {

    const [estConnecte, setEstConnecte] = useState(false);

    const handleConnexion = () => {
        window.location.href = `/login`;    
        setEstConnecte(true);
      };
      
      const handleDeConnexion = () => {
        window.location.href = `/logout`;    
        setEstConnecte(false);
      };
    
    
      const home = () => {
        window.location.href = `/home`;    
    } 
    
    function convertisseur() {
        window.location.href = `/convertisseur/menu`;    
    } 
    
    function chaussure() {
        window.location.href = `/produit/chaussure`;    
    }

    function montre() {
        window.location.href = `/produit/montre`;    
    } 
    
    function solde() {
        window.location.href = `/bank`;    
    } 
    
    function panier() {
        window.location.href = `/panier`;    
    }

    function commande() {
        window.location.href = `/commandes/historique`;    
    }


    return (
        <div>
            <header>
                <h1 className='accueil'></h1>
                <a href='#' onClick={home}><img className='runsport' src={runsport}/></a>
                <div className='bande'>
                    <button  className = 'bandeBouton' type="button" onClick={(chaussure)}>
                        Chaussure
                    </button>       
                    <button  className = 'bandeBouton' type="button" onClick={(montre)}>
                        Montre
                    </button>
                    <button  className = 'bandeBouton' type="button" onClick={(convertisseur)}>
                        Convertisseur
                    </button>
                </div>
                
                <button className = 'panierLogo' type="button" onClick={(panier)}></button>
                    
                <div className="log">
                    <div className="dropdown">
                    {estConnecte ? (
                        <div>         
                            <button className="boutonUser"><img src={userphoto} /></button>
                            <div className="dropdown-content">
                                <button onClick={handleDeConnexion} className="dropdown-item">Deconexion</button>
                            </div>
                        </div>
                    ) : (
                        <div>         
                            <button className="boutonUser"><img src={userphoto} /></button>
                            <div className="dropdown-content">
                                <button onClick={handleConnexion} className="dropdown-item">Se Connecter</button>
                                <a href="/register" className="dropdown-item">S'inscrire</a>
                            </div>
                        </div>

                )}


                    </div>
                </div>
            </header>

            <img className='accueilImage' src={accueilImage} alt="Image d'accueil"/>

            <footer>
                &copy; 2023 RunSport
            </footer>
        </div>
        
    );


}