import React from "react";
import accueilImage from "./photo/accueil.jpg";

export default function home() {
  return (
    <main className="flex-container">
      <div className="text-container">
        <p>
          Bienvenue sur <strong>RunSport</strong>, votre destination ultime pour
          trouver les chaussures et montres de running parfaites qui vous
          accompagneront à chaque foulée. Plongez dans notre univers dédié aux
          passionnés de course à pied, où la performance et le style se
          rencontrent. Chez nous chaque pas compte, et nous sommes là pour vous accompagner dans votre parcours de running.
        </p>
      </div>

      <img
        className="accueilImage"
        src={accueilImage}
        alt="Image d'accueil"
        title="Image d'accueil"
      />
      <div className="text-container">
        <p>
          Mais ce n'est pas tout ! Nous allons au-delà de la simple vente de
          chaussures. Notre site propose également un convertisseur de données
          de course innovant. Suivez votre progression, analysez vos
          performances et convertissez vos données de course.
          Que vous cherchiez à battre votre record personnel ou à vous fixer de
          nouveaux objectifs, notre convertisseur de données de course vous
          offre les outils nécessaires pour optimiser votre entraînement.
        </p>
      </div>
    </main>
  );
}
