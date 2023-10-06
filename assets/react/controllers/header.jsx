import React from "react";
import userphoto from "./photo/utilisateur.png";
import runsport from "./photo/runsport.jpg";

export default function panier() {

  const isUserConnected = () =>
    localStorage.getItem("userConnected") === "true";

  const handleConnexion = () => {
    window.location.href = `/login`;
    localStorage.setItem("userConnected", "true");
  };

  const handleDeConnexion = () => {
    window.location.href = `/logout`;
    localStorage.setItem("userConnected", "false");
  };

  const home = () => {
    window.location.href = `/home`;
  };

  function convertisseur() {
    window.location.href = `/convertisseur`;
  }

  function chaussure() {
    window.location.href = `/produit/chaussure`;
  }

  function montre() {
    window.location.href = `/produit/montre`;
  }

  function solde() {
    window.location.href = `/bank`;
  }

  function panier() {
    window.location.href = `/panier`;
  }

  function commande() {
    window.location.href = `/commandes/historique`;
  }

  return (
    <div>
      <header>
        <h1 className="accueil"></h1>
        <a href="#" onClick={home}>
          <img className="runsport" src={runsport} />
        </a>
        {isUserConnected() ? (
          <div className="bande">
            <button className="bandeBouton" type="button" onClick={chaussure}>
              Chaussures
            </button>
            <button className="bandeBouton" type="button" onClick={montre}>
              Montres
            </button>
            <button
              className="bandeBouton"
              type="button"
              onClick={convertisseur}
            >
              Convertisseur
            </button>
            <button className="bandeBouton" type="button" onClick={commande}>
              Commande
            </button>
            <button className="bandeBouton" type="button" onClick={solde}>
              Solde
            </button>
          </div>
        ) : (
          <div className="bande">
            <button className="bandeBouton" type="button" onClick={chaussure}>
              Chaussures
            </button>
            <button className="bandeBouton" type="button" onClick={montre}>
              Montres
            </button>
            <button
              className="bandeBouton"
              type="button"
              onClick={convertisseur}
            >
              Convertisseur
            </button>
          </div>
        )}

        <button className="panierLogo" type="button" onClick={panier}></button>

        <div className="log">
          <div className="dropdown">
            {isUserConnected() ? (
              <div>
                <button className="boutonUser">
                  <img src={userphoto} />
                </button>
                <div className="dropdown-content">
                  <button onClick={handleDeConnexion} className="dropdown-item">
                    Deconexion
                  </button>
                </div>
              </div>
            ) : (
              <div>
                <button className="boutonUser">
                  <img src={userphoto} />
                </button>
                <div className="dropdown-content">
                  <button onClick={handleConnexion} className="dropdown-item">
                    Se Connecter
                  </button>
                  <a href="/register" className="dropdown-item">
                    S'inscrire
                  </a>
                </div>
              </div>
            )}
          </div>
        </div>
      </header>
    </div>
  );
}
