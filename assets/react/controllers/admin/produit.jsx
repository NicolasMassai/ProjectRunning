import React, { useState, useEffect } from 'react';
import { constantes } from '../../../constante';


export default function produit() {


    const [produits, setProduit] = useState([]);



    useEffect(() => {
    fetch(constantes.url + '/admin/produit/JSON', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);

    
    function update(id) {
        window.location.href = `/admin/produit/update/${id}`;    
    }

    function create() {
        window.location.href = `/admin/produit/create`;    
    }

    function Delete(id) {
        window.location.href = `/admin/produit/delete/${id}`;    
    }

    const [showFullDescription, setShowFullDescription] = useState(false);

    const toggleDescription = () => {
      setShowFullDescription(!showFullDescription);
    };

    return (
        <div className='admin'>
            <h1 className='TitreAdmin'>Gestion des Produits</h1>
            <div className='overflow'>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Couleur</th>
                        <th>Taille</th>
                        <th>Quantité</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    {produits.map(produit => (
                            <tr key = {produit.id}>
                                <td>{produit.nom}</td>
                                <td><img className='produitImage' src={constantes.url + produit.image} alt="produit" /></td>

                                <td>
                                    {showFullDescription ? (
                                        <p>{produit.description}</p>
                                    ) : (
                                        <p>
                                        {produit.description.length > 50
                                            ? `${produit.description.slice(0, 50)}...`
                                            : produit.description}
                                        </p>
                                    )}
                                    {produit.description.length > 50 && (
                                        <button className='boutonPlus' onClick={toggleDescription}>
                                        {showFullDescription ? 'Masquer' : 'Voir plus'}
                                        </button>
                                    )}
                                </td>
                                <td>{produit.prix}</td>                                
                                <td>{produit.couleur}</td>
                                <td>{produit.taille}</td>
                                <td>{produit.quantite}</td>
                                <td>
                                    {<button className = 'boutonProduit' type="button" onClick={(e) => update(produit.id,e)}>
                                        Modifier
                                    </button>}

                                    {<button className = 'boutonProduit' type="button" onClick={(create)}>
                                        Créer
                                    </button>}
                                    
                                    {<button className = 'boutonProduit' type="button" onClick={(e) => Delete(produit.id,e)}>
                                        Supprimer
                                    </button>}
                                </td>                            
                            </tr>    

                    ))}
               

                </tbody>
                <tfoot>
                


                </tfoot>

            </table>
            </div>

        </div>
        
    );


}