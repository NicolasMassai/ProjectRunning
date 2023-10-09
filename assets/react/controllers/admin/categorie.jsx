import React, { useState, useEffect } from 'react';
import { constantes } from '../../../constante';



export default function categories() {


    const [categories, setCategorie] = useState([]);  


    useEffect(() => {
    fetch(constantes.url + '/admin/categorie_produit/JSON', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setCategorie(apiProduit);

    })
    }, []);


    function update(id) {
        window.location.href = `/admin/categorie_produit/update/${id}`;    
    }

    function create() {
        window.location.href = `/admin/categorie_produit/create`;    
    }

    function Delete(id) {
        window.location.href = `/admin/categorie_produit/delete/${id}`;    
    }
    
    return (
        <div className='categorie'>
            <h1 className='TitreAdmin'>Gestion des Catégories</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {categories.map(categorie => (
                            <tr key = {categorie.id}>
                                <td>{categorie.nom}</td>
                                <td>
                                    {<button className = 'boutonProduit' type="button" onClick={(e) => update(categorie.id,e)}>
                                        Modifier
                                    </button>}

                                    {<button className = 'boutonProduit' type="button" onClick={(create)}>
                                        Créer
                                    </button>}
                                    
                                    {<button className = 'boutonProduit' type="button" onClick={(e) => Delete(categorie.id,e)}>
                                        Supprimer
                                    </button>}
                                </td>                            
                            </tr>    

                    ))}
               

                </tbody>
            </table>

        </div>
        
        
    )


}