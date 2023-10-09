import React, { useState, useEffect } from "react";
import runsport from "./photo/runsport.jpg";
import caddie from "./photo/caddie.png";
import loginimage from "./photo/login.jpg";
import logoutimage from "./photo/logout.jpg";
import user from "./photo/utilisateur.png"
import { constantes } from '../../constante';


export default function header() {

  const [produits, setProduit] = useState([]);
  const [links, setLinks] = useState(false);


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
  
  function redirect() {
  produits[0]?.role.includes("ROLE_ADMIN") ?
    window.location.href = `/admin` : 
      window.location.href = '/compte';
  }

  



    useEffect(() => {
      isUserConnected() && 
      fetch(constantes.url + '/compte/JSON', {method : 'GET'})
    .then (response => response.json () )
    .then ( apiProduit => {
        setProduit(apiProduit);

    })
    }, []);



  const handleListe = () => {
    setLinks(!links);
  };

  return (
    <div>
      <header>
        <h1 className="accueil"></h1>
        <div className="divParent">
          <div className="divGauche">
            <img className="runsport"  alt="runsportLogo" src={runsport} onClick={home} />
          </div>
            <div className="divDroite">
              <img className="userLogo" alt="users" src={user} onClick={redirect}/>
              <img className="panierLogo" alt="panier" src={caddie} onClick={panier} />

                {isUserConnected() ? (
                  <img
                    className="logout"
                    alt="deconexion"
                    src={logoutimage}
                    onClick={handleDeConnexion}
                  />
                ) : (
                  <img
                    className="login"
                    alt="connexion"
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
