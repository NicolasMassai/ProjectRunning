import React, { useState, useEffect } from 'react';
import image from './chaussure2.jpg'


export default function (props) {


    const [produit, setProduit] = useState([]);  
    const [currentPage, setCurrentPage] = useState(0);

    useEffect(() => {
    fetch('https://127.0.0.1:8000/produit/chaussure2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);
    
    function bouton(id) {
        window.location.href = `/panier/add/${id}`;    
    }


  const nextPage = () => {
    setCurrentPage((prevPage) => Math.min(prevPage + 1, produit.length - 1));
  };

  const prevPage = () => {
    setCurrentPage((prevPage) => Math.max(prevPage - 1, 0));
  };

  const currentproduit = produit[currentPage];

        return (
            <div>
                <h1>Chaussure</h1>  

                { produit.length === 0 && <span>Loading...</span>}
                {  produit.length > 0  && (
                    <ul>
                            <li key={currentproduit.id}>
                                <img src={currentproduit.image} />
                                <h3>Nom : {currentproduit.nom}</h3>
                                <h3>Description : {currentproduit.description}</h3>
                                <h3>Prix : {currentproduit.prix} €</h3>
                                <h3>Couleur : {currentproduit.couleur}</h3>
                                <h3>Taille : {currentproduit.taille}</h3>
                                {currentproduit.quantite > 0 ? (
                                    <div className='bouton'>
                                        <h3>En Stock, Il reste {currentproduit.quantite} exemplaire(s)</h3> 
                                        <button type="button" onClick={(e) => bouton(currentproduit.id,e)}>
                                            {props.button}
                                        </button>
                                    </div>
                                    ) : (
                                        <h3>En rupture de stock</h3> 
                                    )}
                                
                            </li>
                        
                        <button onClick={prevPage} disabled={currentPage === 0}>
                            Page précédente
                        </button>
                            <span>{currentPage + 1} / {produit.length}</span>
                        <button onClick={nextPage} disabled={currentPage === produit.length - 1}>
                        Page suivante
                        </button>
                    </ul>
                )}
                   
            </div>
            
        );
    
}
