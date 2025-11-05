DROP DATABASE IF EXISTS autoecole;
CREATE DATABASE autoecole;
USE autoecole;
CREATE TABLE candidat (
    idcandidat INT(5) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    tel VARCHAR(50),
    adresse VARCHAR(50),
    PRIMARY KEY (idcandidat)
);

CREATE TABLE moniteur (
    idmoniteur INT(5) NOT NULL AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(50),
    tel VARCHAR(50),
    adresse VARCHAR(50),
    PRIMARY KEY (idmoniteur)
);

CREATE TABLE vehicule (
    idvehicule INT(5) NOT NULL AUTO_INCREMENT,
    marque VARCHAR(50),
    modele VARCHAR(50),
    annee INT(4),
    categorie VARCHAR(50),
    immatriculation VARCHAR(20),
    PRIMARY KEY (idvehicule)
);

CREATE TABLE cours (
    idcours INT(5) NOT NULL AUTO_INCREMENT,
    dateheure DATETIME,
    duree INT(5),
    idcandidat INT(5) NOT NULL,
    idmoniteur INT(5) NOT NULL,
    idvehicule INT(5) NOT NULL,
    PRIMARY KEY (idcours),
    FOREIGN KEY (idcandidat) REFERENCES candidat(idcandidat),
    FOREIGN KEY (idmoniteur) REFERENCES moniteur(idmoniteur),
    FOREIGN KEY (idvehicule) REFERENCES vehicule(idvehicule)
);
CREATE TABLE utilisateur (
    idutilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    mdp VARCHAR(255)
);

-- Compte admin par défaut (mdp = admin123)
INSERT INTO utilisateur (nom, email, mdp)
VALUES ('Administrateur', 'admin@autoecole.com', SHA2('admin123', 256));