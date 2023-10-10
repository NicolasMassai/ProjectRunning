import React, { useState, useEffect } from 'react';
import { constantes } from '../../constante';


export default function userRole() {


    const [produits, setProduit] = useState([]);



    useEffect(() => {
    fetch(constantes.url + '/compte/JSON', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);

    
    function Update(id) {
        window.location.href = `/compte/update/${id}`;    
    } 
    
 

    return (
        <main className='bloc'>
        <div className='article-container'>
            <h1 className='TitreAdmin'>Profil</h1>
            {produits.map(produit => (
                            <li key = {produit.id}>
                                <p>Nom : {produit.nom}</p>
                                <p>Prénom : {produit.prenom}</p>
                                <p>Email : {produit.email}</p>                                
                                <p>Adresse : {produit.adresse}</p>
                                <p>
                                    <button className ='boutonProduit' type="button" onClick={(e) => Update(produit.id,e)}>
                                        Modifier
                                    </button>
                                </p>                            
                            </li>    
            ))}
               

        </div>
        </main>
        
    );


}
