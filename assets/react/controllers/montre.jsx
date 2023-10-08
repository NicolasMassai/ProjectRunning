import React, { useState, useEffect } from 'react';
import { constantes } from '../../constante';



export default function (props) {


    const [produit, setProduit] = useState([]);  
    const [currentPage, setCurrentPage] = useState(0);

    useEffect(() => {
    fetch(constantes.url + '/produit/montre2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);
    
    function bouton(id) {
        window.location.href = `/panier/add/${id}`;    
    }

    function update(id) {
        window.location.href = `/produit/update/${id}`;    
    }

    function create() {
        window.location.href = `/produit/create`;    
    }

    function Delete(id) {
        window.location.href = `/produit/delete/${id}`;    
    }

    function categorie() {
        window.location.href = `/categorie_produit`;    
    }

  const nextPage = () => {
    setCurrentPage((prevPage) => Math.min(prevPage + 1, produit.length - 1));
  };

  const prevPage = () => {
    setCurrentPage((prevPage) => Math.max(prevPage - 1, 0));
  };

  const currentproduit = produit[currentPage];

        return (
            <div className='bloc'>
                { produit.length === 0 && <span>Loading...</span>}
                
                <button className = 'precedent' onClick={prevPage} disabled={currentPage === 0}></button>

                <div className="article-container">
                {  produit.length > 0  && (
                    <ul>
                            <li key={currentproduit.id}>
                                <h1 className='nom'>{currentproduit.nom}</h1>
                                <img src={constantes.url + currentproduit.image} />
                                <p>Description : {currentproduit.description}</p>
                                <p>Prix : {currentproduit.prix} €</p>
                                <p>Couleur : {currentproduit.couleur}</p>
                                <p>Taille de l'écran: {currentproduit.taille} pouces</p>
                                {currentproduit.quantite > 0 ? (
                                    <div>
                                        <p>En Stock, Il reste {currentproduit.quantite} exemplaire(s)</p> 
                                        {currentproduit.role === 'ROLE_USER' && <button className='boutonProduit' type="button" onClick={(e) => bouton(currentproduit.id,e)}>
                                            {props.button}
                                        </button>}
                                    </div>
                                    ) : (
                                        <p>En rupture de stock</p> 
                                    )
                                }

                                <div>
                                    {currentproduit.role === 'ROLE_ADMIN' && <button className = 'boutonProduit' type="button" onClick={(e) => update(currentproduit.id,e)}>
                                        Modifier le produit
                                    </button>}

                                    {currentproduit.role === 'ROLE_ADMIN' && <button className = 'boutonProduit' type="button" onClick={(create)}>
                                        Créer un produit
                                    </button>}

                                    {currentproduit.role === 'ROLE_ADMIN' && <button className = 'boutonProduit' type="button" onClick={(e) => Delete(currentproduit.id,e)}>
                                        Supprimer le produit
                                    </button>}
                                </div>
                                <div>
                                    {currentproduit.role === 'ROLE_ADMIN' && <button className = 'boutonProduit' type="button" onClick={(categorie)}>
                                            Categorie
                                    </button>}
                                </div>
                                <span>{currentPage + 1} / {produit.length}</span>

                                
                            </li>
                        
                    </ul>
                    
                )}
                </div>
                <button className = 'suivant' onClick={nextPage} disabled={currentPage === produit.length - 1}></button>
                   
            </div>
            
            
        );
    
}
