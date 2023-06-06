-- --------------------------------------------- FILM DUNE ---------------------------------------------
-- PERSONNE :REALISATEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('1', 'Villeneuve', 'Denis', 'Homme', '1967-08-03');

-- PERSONNE :ACTEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('2', 'Chalamet', 'Timothé', 'Homme', '1995-12-27');
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('3', 'Ferguson', 'Rebecca', 'Femme', '1983-09-19');

-- REALISATEUR
INSERT INTO `cinema`.`realisateur` (`id_realisateur`, `id_personne`) 
VALUES ('1', '1');

-- ROLE
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('2', 'Lady Jessica Atreides');
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('2', 'Jessica Atreides');

-- ACTEUR 
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('1', '2');
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('2', '3');

-- FILM
INSERT INTO `cinema`.`film` (`id_film`, `titre`, `anneeSortieFrance`, `duree`, `id_realisateur`) 
VALUES ('1', 'Dune', '2021', '155', '1');

-- CASTING
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('1', '1', '1');
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('1', '2', '2');

-- GENRE 
INSERT INTO `cinema`.`genre` (`id_genre`, `genreLibelle`) 
VALUES ('1', 'SF');

-- GENRE FILM
INSERT INTO `cinema`.`genrefilm` (`id_film`, `id_genre`) 
VALUES ('1', '1');

-- --------------------------------------------- FILM Cher John ---------------------------------------------
-- PERSONNE :REALISATEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('4', 'Hallström', 'Sven ', 'Homme', '1946-06-2');

-- PERSONNE :ACTEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('5', 'Tatum ', 'Channing ', 'Homme', '1980-05-26');

INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('6', 'Seyfried ', 'Amanda ', 'Femme', '1985-12-03');

-- REALISATEUR
INSERT INTO `cinema`.`realisateur` (`id_realisateur`, `id_personne`) 
VALUES ('2', '4');

-- ROLE
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('3', 'Jhon Tyree');
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('4', 'Savannah Curtis');

-- ACTEUR 
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('3', '5');
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('4', '6');

-- FILM
INSERT INTO `cinema`.`film` (`id_film`, `titre`, `anneeSortieFrance`, `duree`, `id_realisateur`)
VALUES ('2', 'Cher Jhon', '2010', '105', '2');

-- CASTING
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('2', '3', '3');
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('2', '4', '4');

-- GENRE 
INSERT INTO `cinema`.`genre` (`id_genre`, `genreLibelle`) 
VALUES ('2', 'Romance');

-- GENRE FILM
INSERT INTO `cinema`.`genrefilm` (`id_film`, `id_genre`) 
VALUES ('2', '2');

-- --------------------------------------------- FILM LE CROQUE-MITAINE ---------------------------------------------
-- PERSONNE :REALISATEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('7', 'Savge', 'Rob', 'Homme', '1992-07-01');

-- PERSONNE :ACTEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('8', 'Messina', 'Chris', 'Homme', '1974-08-11');
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('9', 'Thatcher', 'Sophie', 'Femme', '2000-08-18');

-- REALISATEUR
INSERT INTO `cinema`.`realisateur` (`id_realisateur`, `id_personne`) 
VALUES ('3', '7');

-- ROLE
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('5', 'Will');
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('5', 'Will');

-- ACTEUR
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('5', '8');
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('6', '9');

-- FILM
INSERT INTO `cinema`.`film` (`id_film`, `titre`, `anneeSortieFrance`, `duree`, `id_realisateur`) 
VALUES ('3', 'Le Croque Mitaine', '2023', '158', '3');

-- CASTING
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('3', '5', '5');
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('3', '6', '6');

-- GENRE 
INSERT INTO `cinema`.`genre` (`id_genre`, `genreLibelle`) 
VALUES ('3', 'Horreur');

-- GENRE FILM
INSERT INTO `cinema`.`genrefilm` (`id_film`, `id_genre`) 
VALUES ('3', '3');

-- --------------------------------------------- FILM TAXI ---------------------------------------------
-- PERSONNE :REALISATEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('10', 'Pirès', 'Gérard', 'Homme', '1942-08-31');

-- PERSONNE :ACTEUR
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('11', 'Naceri', 'Saïd ', 'Homme', '1961-07-02');
INSERT INTO `cinema`.`personne` (`id_personne`, `nom`, `prenom`, `sexe`, `dateNaissance`) 
VALUES ('12', 'Sjöberg ', 'Emma ', 'Femme', '1968-07-13');

-- REALISATEUR
INSERT INTO `cinema`.`realisateur` (`id_realisateur`, `id_personne`) 
VALUES ('4', '10');

-- ROLE
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('7', 'Daniel Morales');
INSERT INTO `cinema`.`role` (`id_role`, `nomPersonnage`) 
VALUES ('8', 'Petra');

-- ACTEUR
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`)
VALUES ('7', '11');
INSERT INTO `cinema`.`acteur` (`id_acteur`, `id_personne`) 
VALUES ('8', '12');

-- FILM
INSERT INTO `cinema`.`film` (`id_film`, `titre`, `anneeSortieFrance`, `duree`, `id_realisateur`) 
VALUES ('4', 'Taxi', '1998', '86', '4');

-- CASTING
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('4', '7', '7');
INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`) 
VALUES ('4', '8', '8');

-- GENRE 
INSERT INTO `cinema`.`genre` (`id_genre`, `genreLibelle`) 
VALUES ('4', 'Comedie');

-- GENRE FILM
INSERT INTO `cinema`.`genrefilm` (`id_film`, `id_genre`) 
VALUES ('4', '4');