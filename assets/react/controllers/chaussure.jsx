import React, { useState, useEffect } from "react";
import { constantes } from "../../constante";

export default function (props) {
  const [produit, setProduit] = useState([]);
  const [currentPage, setCurrentPage] = useState(0);

  useEffect(() => {
    fetch(constantes.url + "/produit/chaussure/JSON", { method: "GET" })
      .then((response) => response.json())
      .then((apiProduit) => {
        setProduit(apiProduit);
      });
  }, []);

  function bouton(id) {
    window.location.href = `/panier/add/${id}`;
  }

  const nextPage = () => {
    setCurrentPage((prevPage) => Math.min(prevPage + 1, produit.length - 1));
  };

  const prevPage = () => {
    setCurrentPage((prevPage) => Math.max(prevPage - 1, 0));
  };

  const currentproduit = produit[currentPage];

  return (
    <main className="bloc">
      {produit.length === 0 && <span>Loading...</span>}

      <button
        className="precedent"
        onClick={prevPage}
        disabled={currentPage === 0}
      ></button>

      <div className="article-container">
        {produit.length > 0 && (
          <ul>
            <li key={currentproduit.id}>
              <h1 className="nom">{currentproduit.nom}</h1>
              <img
                src={constantes.url + currentproduit.image}
                alt={`${currentproduit.nom} en vente`}
                title={`${currentproduit.nom}`}
              />
              <p>Description : {currentproduit.description}</p>
              <p>Prix : {currentproduit.prix} €</p>
              <p>Couleur : {currentproduit.couleur}</p>
              <p>Taille : {currentproduit.taille}</p>
              {currentproduit.quantite > 0 ? (
                <div>
                  <p>
                    En Stock, Il reste {currentproduit.quantite} exemplaire(s)
                  </p>
                  <button
                    className="boutonProduit"
                    type="button"
                    onClick={(e) => bouton(currentproduit.id, e)}
                  >
                    {props.button}
                  </button>
                </div>
              ) : (
                <p>En rupture de stock</p>
              )}
              <span>
                {currentPage + 1} / {produit.length}
              </span>
            </li>
          </ul>
        )}
      </div>
      <button
        className="suivant"
        onClick={nextPage}
        disabled={currentPage === produit.length - 1}
      ></button>
    </main>
  );
}
