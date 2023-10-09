import React, { useState, useEffect } from 'react';


export default function admin() {

    
    function produit() {
        window.location.href = `/admin/produit`;    
    }
    function categorie_produit() {
        window.location.href = `/admin/categorie_produit`;    
    }
    function utilisateurs() {
        window.location.href = `/admin/utilisateurs`;    
    }


    return (
        <div className='admin'>
            <h1 className='TitreAdmin'>Interface Administrateur</h1>

            {<button className = 'boutonInterfaceAdmin' type="button" onClick={(produit)}>
                Produits
            </button>}

            {<button className = 'boutonInterfaceAdmin' type="button" onClick={(categorie_produit)}>
                Catégories
            </button>}
            
            {<button className = 'boutonInterfaceAdmin' type="button" onClick={(utilisateurs)}>
                Utilisateurs
            </button>}     
        </div>
        
    );


}