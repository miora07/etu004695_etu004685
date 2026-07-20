CREATE DATABASE vente;
USE vente;

CREATE TABLE membre (
    id_membre INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    numero_etu VARCHAR(50) UNIQUE NOT NULL,
    image_profil VARCHAR(200)
);

CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(100) NOT NULL
);

CREATE TABLE produit (
    id_produit INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    id_categorie INT,
    prix_reference FLOAT,
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

CREATE TABLE produit_membre (
    id_produit_membre INT AUTO_INCREMENT PRIMARY KEY,
    id_produit INT,
    id_membre INT,
    prix_vente FLOAT,
    quantite_dispo INT DEFAULT 0,
    date_dispo DATE,
    FOREIGN KEY (id_produit) REFERENCES produit(id_produit),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

CREATE TABLE vente (
    id_vente INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    heure TIME,
    id_produit_membre INT,
    quantite INT,
    FOREIGN KEY (id_produit_membre) REFERENCES produit_membre(id_produit_membre)
);
