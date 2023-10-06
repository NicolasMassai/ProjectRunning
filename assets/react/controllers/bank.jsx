import React, { useState, useEffect } from 'react';
import { constantes } from '../../constante';



export default function panier() {


    const [banks, setBank] = useState([]);  


    useEffect(() => {
    fetch(constantes.url + '/bank2', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setBank(apiProduit);

    })
    }, []);


    function create() {
        window.location.href = `/bank/create`;    
    }
        
    
    return (
        <div className='bank_container'>
            <h1 className='bankTitre'>Votre Solde</h1>

                {banks.map(bank => (
                    <div className='bank_id' key={bank.id} >
                        <p className='bank_solde'>Solde Restant : <b>{bank.solde} €</b></p>
                        <button className='bank_bouton' onClick={create}>
                            Ajouter
                        </button>
                    </div>

                ))}

        </div>
        
        
    )


}