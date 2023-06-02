CREATE TABLE GENRE(
    
   id_genre INT AUTO_INCREMENT,
   genreLibelle VARCHAR(20) NOT NULL,
   PRIMARY KEY(id_genre)
);

CREATE TABLE role(
   id_role INT AUTO_INCREMENT,
   nomPersonnage VARCHAR(20) NOT NULL,
   PRIMARY KEY(id_role)
);

CREATE TABLE PERSONNE(
   id_personne INT AUTO_INCREMENT,
   nom VARCHAR(20) NOT NULL,
   prenom VARCHAR(20) NOT NULL,
   sexe VARCHAR(10) NOT NULL,
   dateNaissance DATE NOT NULL,
   PRIMARY KEY(id_personne)
);

CREATE TABLE ACTEUR(
   id_acteur INT AUTO_INCREMENT,
   id_personne INT NOT NULL,
   PRIMARY KEY(id_acteur),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES PERSONNE(id_personne)
);

CREATE TABLE REALISATEUR(
   id_realisateur INT AUTO_INCREMENT,
   id_personne INT NOT NULL,
   PRIMARY KEY(id_realisateur),
   UNIQUE(id_personne),
   FOREIGN KEY(id_personne) REFERENCES PERSONNE(id_personne)
);

CREATE TABLE FILM(
   id_film INT AUTO_INCREMENT,
   titre VARCHAR(20) NOT NULL,
   anneeSortieFrance INT NOT NULL,
   duree INT NOT NULL,
   etoile INT,
   realisateur VARCHAR(30),
   synopsis TEXT,
   affiche VARCHAR(50),
   id_realisateur INT NOT NULL,
   PRIMARY KEY(id_film),
   UNIQUE(realisateur),
   FOREIGN KEY(id_realisateur) REFERENCES REALISATEUR(id_realisateur)
);

CREATE TABLE GenreFilm(
   id_film INT ,
   id_genre INT,
   PRIMARY KEY(id_film, id_genre),
   FOREIGN KEY(id_film) REFERENCES FILM(id_film),
   FOREIGN KEY(id_genre) REFERENCES GENRE(id_genre)
);

CREATE TABLE jouer(
   id_film INT,
   id_acteur INT,
   id_role INT,
   PRIMARY KEY(id_film, id_acteur, id_role),
   FOREIGN KEY(id_film) REFERENCES FILM(id_film),
   FOREIGN KEY(id_acteur) REFERENCES ACTEUR(id_acteur),
   FOREIGN KEY(id_role) REFERENCES role(id_role)
);
