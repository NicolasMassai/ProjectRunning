import React, { useState, useEffect } from "react";
import { constantes } from "../../constante";

export default function panier() {
  const [produits, setProduit] = useState([]);

  useEffect(() => {
    fetch(constantes.url + "/panier/JSON", { method: "GET" })
      .then((response) => response.json())
      .then((apiProduit) => {
        setProduit(apiProduit);
      });
  }, []);

  function boutonadd(id) {
    window.location.href = `/panier/add/${id}`;
  }

  function boutondelete(id) {
    window.location.href = `/panier/delete/${id}`;
  }

  function boutonremove(id) {
    window.location.href = `/panier/remove/${id}`;
  }

  function boutonempty() {
    window.location.href = `/panier/empty`;
  }
  function boutonbuy() {
    window.location.href = `/panier/buy`;
  }

  const prixTotal = () => {
    const nouveauTableau = [...produits];

    const tableau = nouveauTableau.map((produit, index) => {
      if (index === nouveauTableau.length - 1) {
        nouveauTableau.push(produit.quantity * produit.prix);
        return produit.quantity * produit.prix;
      }

      return produit.quantity * produit.prix;
    });

    const somme = tableau.reduce((acc, valeur) => acc + valeur, 0);
    window.maVariableGlobale = somme;
  };
  prixTotal();

  useEffect(() => {
    prixTotal();
  }, [boutonadd]);

  return (
    <main className="panier">
      <h1 className="PanierTitre">Votre Panier</h1>
      <div className="overflow">
        {maVariableGlobale != 0 ? (
          <table>
            <thead>
              <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Sous-Total</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {produits.map((produit) => (
                <tr key={produit.id}>
                  <td className="panierNom">
                    {produit.nom}
                    <img
                      className="panierImage"
                      src={produit.image}
                      alt={`${produit.nom} dans le panier`}
                      title={`${produit.nom}`}
                    />
                  </td>
                  <td>{produit.prix} €</td>
                  <td>{produit.quantity}</td>
                  <td>{produit.quantity * produit.prix}€</td>
                  <td>
                    {produit.quantity < produit.quantityTotal ? (
                      <button
                        className="add"
                        type="button"
                        onClick={(e) => boutonadd(produit.id, e)}
                      ></button>
                    ) : (
                      <button
                        disabled={true}
                        className="add"
                        type="button"
                        onClick={(e) => boutonadd(produit.id, e)}
                      ></button>
                    )}
                    <button
                      className="remove"
                      type="button"
                      onClick={(e) => boutonremove(produit.id, e)}
                    ></button>
                    <button
                      className="delete"
                      type="button"
                      onClick={(e) => boutondelete(produit.id, e)}
                    ></button>
                  </td>
                </tr>
              ))}
            </tbody>
            <tfoot>
              {maVariableGlobale != 0 ? (
                <tr className="total">
                  <td colSpan="3">Total</td>
                  <td>{maVariableGlobale} €</td>
                  <td>
                    <button className="buy" type="button" onClick={boutonbuy}>
                      Acheter
                    </button>
                  </td>
                </tr>
              ) : null}
            </tfoot>
          </table>
        ) : (
          "Le Panier est vide"
        )}

        {maVariableGlobale != 0 ? (
          <button className="empty" type="button" onClick={boutonempty}>
            Vider
          </button>
        ) : null}
      </div>
    </main>
  );
}
