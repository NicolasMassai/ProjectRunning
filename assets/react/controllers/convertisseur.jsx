import React, { useState } from "react";

const Convertisseur = () => {
  const [distance, setDistance] = useState("");
  const [tempsHeures, setTempsHeures] = useState("");
  const [tempsMinutes, setTempsMinutes] = useState("");
  const [tempsSecondes, setTempsSecondes] = useState("");
  const [allureMinutes, setAllureMinutes] = useState("");
  const [allureSecondes, setAllureSecondes] = useState("");
  const [vitesse, setVitesse] = useState("");

  const handleChange = (e) => {
    const { name, value } = e.target;
    if (name === "distance") {
      setDistance(value);
    } else if (name === "tempsHeures") {
      setTempsHeures(value);
    } else if (name === "tempsMinutes") {
      setTempsMinutes(value);
    } else if (name === "tempsSecondes") {
      setTempsSecondes(value);
    } else if (name === "allureMinutes") {
      setAllureMinutes(value);
    } else if (name === "allureSecondes") {
      setAllureSecondes(value);
    } else if (name === "vitesse") {
      setVitesse(value);
    }
  };

  const convertir = (e) => {
    if (distance && tempsHeures && tempsMinutes && tempsSecondes) {
      convertirDistanceTempsVersAllure(e);
    } else if (
      allureMinutes &&
      allureSecondes &&
      tempsHeures &&
      tempsMinutes &&
      tempsSecondes
    ) {
      convertirAllureTempsVersDistance(e);
    } else if (allureMinutes && allureSecondes && distance) {
      convertirAllureDistanceVersTemps(e);
    } else if (vitesse && tempsHeures && tempsMinutes && tempsSecondes) {
      convertirVitesseTempsVersDistance(e);
    } else if (vitesse && distance) {
      convertirVitesseDistanceVersTemps(e);
    } else if (allureMinutes && allureSecondes) {
      convertirAllureVersVitesse(e);
    } else if (vitesse) {
      convertirVitesseVersAllure(e);
    }
  };

  const convertirDistanceTempsVersAllure = (e) => {
    e.preventDefault();
    const tempsTotalEnMinutes =
      parseFloat(tempsHeures) * 60 +
      parseFloat(tempsMinutes) +
      parseFloat(tempsSecondes) / 60;
    const allureEnMinutes2 = tempsTotalEnMinutes / parseFloat(distance);
    const allureMinutes = Math.floor(allureEnMinutes2);
    const allureSecondes = Math.round((allureEnMinutes2 - allureMinutes) * 60);
    setAllureMinutes(allureMinutes.toString());
    setAllureSecondes(allureSecondes.toString());
    const allureEnMinutes =
      parseFloat(allureMinutes) + parseFloat(allureSecondes) / 60;
    const nouvelleVitesse = 60 / allureEnMinutes;
    setVitesse(nouvelleVitesse.toFixed(2));
  };

  const convertirAllureVersVitesse = (e) => {
    e.preventDefault();
    const allureEnMinutes =
      parseFloat(allureMinutes) + parseFloat(allureSecondes) / 60;
    const nouvelleVitesse = 60 / allureEnMinutes;
    setVitesse(nouvelleVitesse.toFixed(2));
  };

  const convertirVitesseVersAllure = (e) => {
    e.preventDefault();
    const nouvelleAllureEnMinutes = 60 / parseFloat(vitesse);
    const nouvelleAllureMinutes = Math.floor(nouvelleAllureEnMinutes);
    const nouvelleAllureSecondes = Math.round(
      (nouvelleAllureEnMinutes - nouvelleAllureMinutes) * 60
    );
    setAllureMinutes(nouvelleAllureMinutes.toString());
    setAllureSecondes(nouvelleAllureSecondes.toString());
  };

  const convertirAllureDistanceVersTemps = (e) => {
    e.preventDefault();
    const allureEnMinutes =
      parseFloat(allureMinutes) + parseFloat(allureSecondes) / 60;
    const tempsTotalEnHeures = (allureEnMinutes * parseFloat(distance)) / 60;
    const tempsTotalEnMinutes = tempsTotalEnHeures * 60;
    const tempsTotalHeures = Math.floor(tempsTotalEnHeures);
    const tempsTotalMinutes = Math.floor(tempsTotalEnMinutes % 60);
    const tempsTotalSecondes = Math.round((tempsTotalEnMinutes % 1) * 60);
    setTempsHeures(tempsTotalHeures.toString());
    setTempsMinutes(tempsTotalMinutes.toString());
    setTempsSecondes(tempsTotalSecondes.toString());
    const nouvelleVitesse = 60 / allureEnMinutes;
    setVitesse(nouvelleVitesse.toFixed(2));
  };

  const convertirAllureTempsVersDistance = (e) => {
    e.preventDefault();
    const allureEnMinutes =
      parseFloat(allureMinutes) + parseFloat(allureSecondes) / 60;
    const tempsTotalEnHeures =
      parseFloat(tempsHeures) * 60 +
      parseFloat(tempsMinutes) +
      parseFloat(tempsSecondes) / 60;
    const distanceEnKilometres = tempsTotalEnHeures / allureEnMinutes;
    setDistance(distanceEnKilometres.toFixed(2).toString());
    const nouvelleVitesse = 60 / allureEnMinutes;
    setVitesse(nouvelleVitesse.toFixed(2));
  };

  const convertirVitesseTempsVersDistance = (e) => {
    e.preventDefault();
    const tempsTotalEnHeures =
      parseFloat(tempsHeures) +
      parseFloat(tempsMinutes) / 60 +
      parseFloat(tempsSecondes) / 3600;
    const nouvelleVitesse = parseFloat(vitesse);
    const distanceEnKilometres = tempsTotalEnHeures * nouvelleVitesse;
    setDistance(distanceEnKilometres.toFixed(2).toString());
    convertirVitesseVersAllure(e);
  };

  const convertirVitesseDistanceVersTemps = (e) => {
    e.preventDefault();
    const distanceEnKilometres = parseFloat(distance);
    const nouvelleVitesse = parseFloat(vitesse);
    const tempsTotalEnHeures = distanceEnKilometres / nouvelleVitesse;
    const tempsTotalEnMinutes = tempsTotalEnHeures * 60;
    const tempsTotalHeures = Math.floor(tempsTotalEnHeures);
    const tempsTotalMinutes = Math.floor(tempsTotalEnMinutes % 60);
    const tempsTotalSecondes = Math.round((tempsTotalEnMinutes % 1) * 60);
    setTempsHeures(tempsTotalHeures.toString());
    setTempsMinutes(tempsTotalMinutes.toString());
    setTempsSecondes(tempsTotalSecondes.toString());
    convertirVitesseVersAllure(e);
  };

  const reset = (e) => {
    e.preventDefault();
    setVitesse("");
    setAllureMinutes("");
    setAllureSecondes("");
    setTempsHeures("");
    setTempsMinutes("");
    setTempsSecondes("");
    setDistance("");
  };

  return (
    <main className="convertisseur">
      <label className="titreConvertisseur">Convertisseur</label>
      <form className="formulaire">
        <div className="gauche">
          <br />
          <div>
            <label className="titreInput">Distance :</label>
            <input
              className="inputConvert"
              type="text"
              name="distance"
              placeholder="Kilomètres"
              value={distance}
              onChange={handleChange}
            />
          </div>
          <br />
          <div>
            <label className="titreInput">Temps :</label>
            <input
              className="inputConvert
"
              type="text"
              name="tempsHeures"
              placeholder="Heures"
              value={tempsHeures}
              onChange={handleChange}
            />
            <input
              className="inputConvert
"
              type="text"
              name="tempsMinutes"
              placeholder="Minutes"
              value={tempsMinutes}
              onChange={handleChange}
            />
            <input
              className="inputConvert
"
              type="text"
              name="tempsSecondes"
              placeholder="Secondes"
              value={tempsSecondes}
              onChange={handleChange}
            />
          </div>
        </div>
        <div className="droite">
          <br />
          <div>
            <label className="titreInput">Allure :</label>
            <input
              className="inputConvert"
              type="text"
              name="allureMinutes"
              placeholder="Minutes"
              value={allureMinutes}
              onChange={handleChange}
            />
            <input
              className="inputConvert"
              type="text"
              name="allureSecondes"
              placeholder="Secondes"
              value={allureSecondes}
              onChange={handleChange}
            />
          </div>
          <br />
          <label className="titreInput">Vitesse :</label>
          <input
            className="inputConvert"
            type="text"
            name="vitesse"
            placeholder="km/h"
            value={vitesse}
            onChange={handleChange}
          />
        </div>
      </form>
      <div>
        <br />
        <button className="btn_convertir" onClick={convertir}>
          Convertir
        </button>
        <button className="btn_reset" onClick={reset}>
          Reset
        </button>
      </div>
    </main>
  );
};

export default Convertisseur;
