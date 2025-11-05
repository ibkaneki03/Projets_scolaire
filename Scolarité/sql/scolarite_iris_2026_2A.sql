drop DATABASE if EXISTS scolarite_iris_2026_2A;
CREATE DATABASE scolarite_iris_2026_2A;
use scolarite_iris_2026_2A;

create table classe(
    idclasse int(5) not null auto_increment,
    nom varchar(50),
    salle varchar(50),
    diplome varchar(50),
    PRIMARY KEY(idclasse)
);
create table etudiant(
    idetudiant int(5) not null auto_increment,
    nom varchar(50),
    prenom varchar(50),
    email varchar(50),
    tel varchar(50),
    adresse varchar(50),
    idclasse int(5) not null,
    PRIMARY KEY(idetudiant),
    FOREIGN KEY(idclasse) REFERENCES classe(idclasse)
);
create table professeur(
    idprofesseur int(5) not null auto_increment,
    nom varchar(50),
    prenom varchar(50),
    email varchar(50),
    diplome varchar(50),
    PRIMARY KEY(idprofesseur)
);
create table matiere(
    idmatieres int(5) not null auto_increment,
    nom varchar(50),
    coeff int(5),
    nbheures int(5),
    idclasse int(5) not null,
    idprofesseur int(5) not null,
    PRIMARY KEY(idmatieres),
    FOREIGN KEY(idclasse) REFERENCES classe(idclasse),
    FOREIGN KEY(idprofesseur) REFERENCES professeur(idprofesseur)
);