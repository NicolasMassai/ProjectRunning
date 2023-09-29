import React from 'react';
export default function btn_chaussure(props) {
 



    function bouton() {
        window.location.href = '/produit/chaussure';    
    }

    return (


    <div className='bouton'>
        <button type="button" onClick={bouton}>
            {props.button}
        </button>
    </div>
    );
}
