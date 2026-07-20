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
    quantite_dispo INT ,
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


INSERT INTO membre (nom, numero_etu, image_profil) VALUES
('Miora', 'etu004695', 'miora.jpg'),
('Fitia', 'etu004696', 'fitia.jpg'),
('Lucas', 'etu004702', 'lucas.jpg'),
('Sedra', 'etu004703', 'sedra.jpg'),
('Johanna', 'etu004697', 'johanna.jpg'),
('Johnattan', 'etu004698', 'johnattan.jpg'),
('Raissa', 'etu004699', 'raissa.jpg'),
('Mendrika', 'etu004700', 'mendrika.jpg'),
('Tsiky', 'etu004701', 'tsiky.jpg'),
('Harena', 'etu004704', 'harena.jpg');

INSERT INTO categorie (nom_categorie) VALUES
('plat'),
('boisson'),
('snack'),
('dessert');


INSERT INTO produit (nom, id_categorie, prix_reference) VALUES

('Riz au poulet', 1, 4500.00),
('Sauce zebut', 1, 3500.00),
('Lasary', 1, 1500.00),
('Koba', 1, 2000.00),

('Coca 33cl', 2, 2000.00),
('Eau 50cl', 2, 1000.00),
('Jus ananas', 2, 2500.00),
('The glacé', 2, 2200.00),

('Sambos boeuf', 3, 800.00),
('Nem poulet', 3, 1000.00),
('Chips', 3, 1500.00),
('Gateau sec', 3, 500.00),

('Yaourt', 4, 1800.00),
('Salade de fruits', 4, 3000.00),
('Mousse au chocolat', 4, 3500.00);

INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) VALUES
(1, 1, 5000.00, 5, '2026-04-24'), 
(2, 1, 4000.00, 3, '2026-04-24'),  
(5, 2, 2200.00, 10, '2026-04-24'), 
(6, 2, 1200.00, 8, '2026-04-24'),  
(9, 3, 900.00, 15, '2026-04-24'), 
(10, 3, 1100.00, 12, '2026-04-24'),
(13, 4, 2000.00, 6, '2026-04-24'), 
(15, 4, 3800.00, 4, '2026-04-24'), 
(3, 5, 1700.00, 7, '2026-04-24'),  
(7, 5, 2700.00, 5, '2026-04-24'),  
(11, 6, 1700.00, 9, '2026-04-24'), 
(12, 6, 600.00, 20, '2026-04-24'), 
(4, 7, 2200.00, 10, '2026-04-24'), 
(8, 7, 2400.00, 6, '2026-04-24'),  
(14, 8, 3200.00, 3, '2026-04-24'), 
(1, 8, 4800.00, 2, '2026-04-24'),  
(5, 9, 2100.00, 5, '2026-04-24'),  
(9, 9, 850.00, 8, '2026-04-24'),   
(13, 10, 1900.00, 4, '2026-04-24'),
(2, 10, 3800.00, 2, '2026-04-24'); 

ALTER TABLE produit_membre ADD COLUMN photo VARCHAR(200);
