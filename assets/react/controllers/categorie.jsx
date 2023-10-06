import React, { useState, useEffect } from 'react';
import { constantes } from '../../constante';



export default function categories() {


    const [categories, setCategorie] = useState([]);  


    useEffect(() => {
    fetch(constantes.url + '/categorie_produit2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setCategorie(apiProduit);

    })
    }, []);


    function create() {
        window.location.href = `/categorie_produit/create`;    
    }
        
    
    return (
        <div className='bank_container'>
            <h1 className='bankTitre'>Les categories disponibles : </h1>

                {categories.map(categorie => (
                    <div className='bank_id' key={categorie.id} >
                        <p><b>{categorie.nom}</b></p>
                    </div>

                ))}
                <button className='bank_bouton' onClick={create}>
                    Créer un Catégorie
                </button>

        </div>
        
        
    )


}