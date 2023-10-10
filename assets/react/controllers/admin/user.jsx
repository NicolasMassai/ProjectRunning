import React, { useState, useEffect } from 'react';
import { constantes } from '../../../constante';


export default function user() {


    const [produits, setProduit] = useState([]);



    useEffect(() => {
    fetch(constantes.url + '/admin/utilisateurs/JSON', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);

    
    function Update(id) {
        window.location.href = `/admin/utilisateurs/update/${id}`;    
    } 
    
    function Delete(id) {
        window.location.href = `/admin/utilisateurs/delete/${id}`;    
    }


    return (
        <main className='admin'>
            <h1 className='TitreAdmin'>Gestion des Utilisateurs</h1>
            <div className='overflow'>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Adresse</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {produits.map(produit => (
                            <tr key = {produit.id}>
                                <td>{produit.nom}</td>
                                <td>{produit.prenom}</td>
                                <td>{produit.email}</td>                                
                                <td>{produit.adresse}</td>
                                <td>{produit.roles}</td>
                                <td>
                                    <button className ='boutonProduit' type="button" onClick={(e) => Update(produit.id,e)}>
                                        Modifier
                                    </button>  <button className ='boutonProduit' type="button" onClick={(e) => Delete(produit.id,e)}>
                                        Supprimer
                                    </button> 
                                </td>                            
                            </tr>    

                    ))}
               

                </tbody>
            </table>
            </div>

        </main>
        
    );


}