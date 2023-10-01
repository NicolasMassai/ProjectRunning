import React, { useState, useEffect } from 'react';

export default function (props) {


    const [produits, setProduit] = useState([]);  
    const [currentPage, setCurrentPage] = useState(0);

    useEffect(() => {
    fetch('https://127.0.0.1:8000/panier/2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);


    function boutonadd(id) {
        window.location.href = `/panier/add/${id}`;    
    }
    
    function boutondelete(id) {
        window.location.href = `/panier/delete/${id}`;    
    }
    
    function boutonremove(id) {
        window.location.href = `/panier/remove/${id}`;    
    }
    
    function boutonempty() {
        window.location.href = `/panier/empty`;    
    }
    function boutonbuy() {
        window.location.href = `/panier/buy`;    
    }


    

    return (
        <div>
            <h1>Panier</h1>
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {produits.map(produit => (
                            <tr>
                                <td>{produit.nom}</td>
                                <td>{produit.prix} €</td>
                                <td>{produit.quantity}</td>
                                <td>{produit.quantity * produit.prix}€</td>
                                
                                <td>
                                    <button type="button" onClick={(e) => boutonadd(produit.id,e)}>
                                        {props.button}
                                    </button>
                                    <button type="button" onClick={(e) => boutonremove(produit.id,e)}>
                                        -
                                    </button>
                                    <button type="button" onClick={(e) => boutondelete(produit.id,e)}>
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                            

                    ))}
               

                </tbody>
                <tfoot>
                    
                {produits.map(produit => (
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{produit.quantity * produit.prix}€</td>
                        <td>
                            <button type="button" onClick={(boutonempty)}>
                                        Vider
                            </button>
                        </td>
                    </tr>
                ))}

                </tfoot>

                </table>
                
                <button type="button" onClick={(boutonbuy)}>
                    Acheter
                </button>
        </div>
        
    );


}