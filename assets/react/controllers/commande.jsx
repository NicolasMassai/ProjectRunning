import React, { useState, useEffect } from 'react';
import { constantes } from '../../constante';


export default function commande() {


    const [produits, setProduit] = useState([]);



    useEffect(() => {
    fetch(constantes.url + '/commandes/historique/JSON', {method : 'GET'})
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

        // On utilise un objet pour regrouper les produits par ID
        const idGroups = {};

        // on parcours chaque produit dans le tableau
        produits.forEach((produit) => {
        
            // Si le groupe pour cet ID n'existe pas, on le créer
        if (!idGroups[produit.id]) {
            idGroups[produit.id] = [];
        }
        // On ajoute le produit au groupe correspondant
        idGroups[produit.id].push(produit);
        });

        // On parcours chaque groupe d'ID
        for (const id in idGroups) {
            const produits = idGroups[id]; // Liste des produits pour cet ID
            const colSpan = produits.length; // Nombre de lignes verticales à fusionner

            // On Crée une ligne avec la cellule ID fusionnée verticalement
            rows.push(
                <tr key={id}>
                    <td rowSpan={colSpan}>{id}</td>
                    <td>{produits[0].nom}</td>
                    <td>{produits[0].quantite}</td>
                    <td>{produits[0].prix} €</td>
                    <td>{produits[0].quantite * produits[0].prix} €</td>
                    <td rowSpan={colSpan}>{maVariableGlobale[id]} €</td>
                </tr>
            );

                // Pour les lignes suivantes, on crée une nouvelle ligne pour chaque produit
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
        <main className='Commande'>
            <h1 className='commandeTitre'> Vos Commandes</h1>
            <div className='overflow'>

            <table>
                <thead>
                    <tr>
                        <th>Commande</th>
                        <th>Nom</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Sous-Total</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>    
                {fusionnerCellules()} 
                </tbody>
            </table>
            </div>
        </main>
        
    );


}