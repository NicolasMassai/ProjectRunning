import React, { useState } from 'react';

export default function (props) {

    const [produit, setProduit] = useState([]);

    fetch('https://127.0.0.1:8000/produit/chaussure', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit)
    })

        return (
            <div>
                {  produit.length > 0  && (
                    <ul>

                        {produit.map(produit => (
                            <li key={produit.id}>
                                <h3>{produit.nom}</h3>
                            </li>
                        ))}
                    </ul>
                )}
            </div>
        );
    
}
