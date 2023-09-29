import React, { useState, useEffect } from 'react';

export default function (props) {

    const [produit, setProduit] = useState([]);  

    useEffect(() => {
    fetch('https://127.0.0.1:8000/produit/montre2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);
    
    function bouton(id) {
        window.location.href = `/panier/add/${id}`;    
    }


        return (
            <div>
                <h1>Montre</h1>

                { produit.length === 0 && <span>Loading...</span>}
                {  produit.length > 0  && (
                    <ul>
                        {produit.map(produit => (
                            <li key={produit.id}>
                                <h3>Nom : {produit.nom}</h3>
                                <h3>Description : {produit.description}</h3>
                                <h3>Prix : {produit.prix} €</h3>
                                <h3>Couleur : {produit.couleur}</h3>
                                <h3>Taille de l'écran : {produit.taille} pouces</h3>
                                {produit.quantite > 0 ? (
                                    <div className='bouton'>
                                        <h3>En Stock, Il reste {produit.quantite} exemplaire(s)</h3> 
                                        <button type="button" onClick={(e) => bouton(produit.id,e)}>
                                            {props.button}
                                        </button>
                                    </div>
                                    ) : (
                                        <h3>En rupture de stock</h3> 
                                    )}
                                
                            </li>
                        ))} 
                        
                       
                    </ul>
                )}
                   
            </div>
        );
    
}
