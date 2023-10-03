import React, { useState, useEffect } from 'react';
import image from './chaussure1.jpg'


export default function panier(props) {


    const [produits, setProduit] = useState([]);



    useEffect(() => {
    fetch('https://127.0.0.1:8000/commandes/historique2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);

    
    const calculerSommeParId = () => {
    const sommeParId = {};

    produits.forEach((item) => {
      const { id, total } = item;
      sommeParId[id] = (sommeParId[id] || 0) + total;
    });
    window.maVariableGlobale = sommeParId;

  };

  calculerSommeParId();
        


    const fusionnerCellules = () => {

        const rows = [];
        // Utiliser un objet pour regrouper les produits par ID
        const idGroups = {};

        // Parcourir chaque produit dans le tableau
        produits.forEach((produit) => {
        
            // Si le groupe pour cet ID n'existe pas, le créer
        if (!idGroups[produit.id]) {
            idGroups[produit.id] = [];
        }
        // Ajouter le produit au groupe correspondant
        idGroups[produit.id].push(produit);
        });

        // Parcourir chaque groupe d'ID
        for (const id in idGroups) {
            const produits = idGroups[id]; // Liste des produits pour cet ID
            const colSpan = produits.length; // Nombre de lignes verticales à fusionner

            // Créer une ligne avec la cellule ID fusionnée verticalement
            rows.push(
                <tr className = 'commande' key={id}>
                    <td className ='commande' rowSpan={colSpan}>{id}</td>
                    <td>{produits[0].nom}</td>
                    <td>{produits[0].quantite}</td>
                    <td>{produits[0].prix} €</td>
                    <td>{produits[0].quantite * produits[0].prix} €</td>
                    <td rowSpan={colSpan}>{maVariableGlobale[id]} €</td>
                </tr>
            );

                // Pour les lignes suivantes, créer une nouvelle ligne pour chaque produit
            for (let i = 1; i < colSpan; i++) {
                rows.push(
                <tr key={`${id}-${i}`}>
                    <td>{produits[i].nom}</td>
                    <td>{produits[i].quantite}</td>
                    <td>{produits[i].prix} €</td>
                    <td>{produits[i].quantite * produits[i].prix} €</td>
                </tr>
                );
            }
        }
    
    return rows;
    };
    


    return (
        <div className=''>
            <h1 className='commandeTitre'>Commande</h1>

            <table>
                <thead>
                    <tr>
                        <th>Commande</th>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Total</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>    
                {fusionnerCellules()} 
                </tbody>
                <tfoot>

                </tfoot>

            </table>
        </div>
        
    );


}