-- a.Informations d’un film (id_film)
SELECT titre,anneeSortieFrance,duree,realisateur
FROM film
WHERE id_film = 1;

-- b.Liste des films dont la durée excède 2h15 classés par durée  /!\ probleme
SELECT titre,SEC_TO_TIME(duree*60) AS `duree`
FROM film
WHERE duree>135;

-- c.Liste des films d’un réalisateur
SELECT titre,anneeSortieFrance
FROM film
WHERE id_realisateur = 1;

-- d.Nombre de films par genre
SELECT COUNT(id_film) AS nbrFilm ,genreLibelle
FROM genreFilm,genre
WHERE genrefilm.id_genre = genre.id_genre
AND genre.genreLibelle = 'Horreur';

-- e.Nombre de films par réalisateur
SELECT realisateur,COUNT(id_film) AS nbrFilm
FROM film
GROUP BY id_film
ORDER BY nbrFilm DESC;

-- f. Casting d’un film en particulier (id_film)
SELECT nom,prenom,sexe
FROM personne,acteur,jouer
WHERE personne.id_personne = acteur.id_personne
AND acteur.id_acteur = jouer.id_acteur
AND id_film = 1;

-- g. Films tournés par un acteur en particulier
SELECT titre,role.nomPersonnage,anneeSortieFrance
FROM film,jouer,role
WHERE film.id_film = jouer.id_film
AND jouer.id_role = role.id_role
AND jouer.id_acteur = 1;

-- h. Liste des personnes qui sont à la fois acteurs et réalisateurs
SELECT nom,prenom
FROM personne
WHERE id_personne IN (SELECT id_personne FROM acteur)
AND id_personne IN (SELECT id_personne FROM realisateur);

-- i. Liste des films qui ont moins de 5 ans
SELECT titre,YEAR(CURDATE())  - anneeSortieFrance AS annee
FROM film
HAVING annee < 30
ORDER BY anneeSortieFrance DESC;

-- j. Nombre d’hommes et de femmes parmi les acteurs
SELECT (SELECT COUNT(id_acteur)
		FROM acteur,personne
		WHERE acteur.id_personne = personne.id_personne	
		AND sexe ='Femme')AS nbrFemme,

	(SELECT COUNT(id_acteur)
		FROM acteur,personne
		WHERE acteur.id_personne = personne.id_personne	
		AND sexe ='Homme') AS nbrHomme

	
-- k. Liste des acteurs ayant plus de 50 ans(âge révolu et non révolu)
SELECT nom,prenom,TIMESTAMPDIFF(YEAR, PERSONNE.dateNaissance, CURDATE()) AS Age
FROM acteur,personne
WHERE acteur.id_personne = personne.id_personne 
HAVING Age >50;
