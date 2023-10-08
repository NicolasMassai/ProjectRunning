import React, { useState } from "react";
import runsport from "./photo/runsport.jpg";
import caddie from "./photo/caddie.png";
import loginimage from "./photo/login.jpg";
import logoutimage from "./photo/logout.jpg";

export default function header() {
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


  function home(){
    window.location.href = `/home`;
  };

 
  function panier() {
    window.location.href = `/panier`;
  }


  const [links, setLinks] = useState(false);

  const handleListe = () => {
    setLinks(!links);
  };

  return (
    <div>
      <header>
        <h1 className="accueil"></h1>
        <div className="divParent">
          <div className="divGauche">
            <img className="runsport"  alt="runsport" src={runsport} onClick={home} />
          </div>
            <div className="divDroite">
                <img className="panierLogo" src={caddie} onClick={panier} />

                {isUserConnected() ? (
                  <img
                    className="logout"
                    src={logoutimage}
                    onClick={handleDeConnexion}
                  />
                ) : (
                  <img
                    className="login"
                    src={loginimage}
                    onClick={handleConnexion}
                  />
                )}
          </div>
        </div>
        {isUserConnected() ? (
          <nav className={`navbar ${links ? "show-nav" : "hide-show"}`}>
            <div></div>
            <ul className="navbar_links">
              <li className="navbar_item slide1" >
                <a href="/produit/chaussure" className="navbar_link">
                  Chaussures
                </a>
              </li>
              <li className="navbar_item slide2">
                <a href="/produit/montre" className="navbar_link">
                  Montres
                </a>
              </li>
              <li className="navbar_item slide3">
                <a href="/convertisseur" className="navbar_link">
                  Convertisseur
                </a>
              </li>
              <li className="navbar_item slide4">
                <a href="/commandes/historique" className="navbar_link">
                  Commande
                </a>
              </li>
              <li className="navbar_item slide5">
                <a href="/bank" className="navbar_link">
                  Solde
                </a>
              </li>
            </ul>
            <button className="navbar_menu" onClick={handleListe}>
              <span className="menu_bar"></span>
            </button>
          </nav>
        ) : (
          <nav className={`navbar ${links ? "show-nav" : "hide-show"}`}>
            <div></div>
            <ul className="navbar_links">
              <li className="navbar_item slide1">
                <a href="/produit/chaussure" className="navbar_link">
                  Chaussures
                </a>
              </li>
              <li className="navbar_item slide2">
                <a href="/produit/montre" className="navbar_link">
                  Montres
                </a>
              </li>
              <li className="navbar_item slide3">
                <a href="/convertisseur" className="navbar_link">
                  Convertisseur
                </a>
              </li>
            </ul>
            <button className="navbar_menu" onClick={handleListe}>
              <span className="menu_bar"></span>
            </button>
          </nav>
        )}
      </header>
    </div>
  );
}
