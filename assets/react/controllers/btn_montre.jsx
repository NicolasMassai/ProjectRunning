import React from 'react';
export default function btn_montre(props) {
 

    function bouton() {
        window.location.href = '/produit/montre';    
    }

    return (


        <button className='bouton' type="button" onClick={bouton}>
            {props.button}
        </button>
    );
}
