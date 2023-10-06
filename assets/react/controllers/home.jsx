import React from "react";
import accueilImage from "./photo/accueil.jpg";

export default function home() {


  return (
    <div>
      <img className="accueilImage" src={accueilImage} alt="Image d'accueil" />
    </div>
  );
}
