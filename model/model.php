<?php 

require_once "connexion.php";

function recupFilm(){
    $sqlFilm = '
    SELECT titre,anneeSortieFrance,affiche,id_film
    FROM film
    ORDER BY anneeSortieFrance DESC;';

    $filmsStatement = connexion()->prepare($sqlFilm);
    $filmsStatement->execute();
    return $filmsStatement->fetchAll();
}

function descrFilm($id){
    $sqlDescrFilm = "
    SELECT titre,anneeSortieFrance,affiche,genreLibelle,pr.nom,pr.prenom, pa.nom,pa.prenom, role.nomPersonnage
    FROM film ,realisateur,acteur ,personne pr, personne pa,jouer, role,genre,genreFilm
    WHERE film.id_realisateur = realisateur.id_realisateur
    AND realisateur.id_personne = pr.id_personne
    AND acteur.id_personne = pa.id_personne
    AND film.id_film = jouer.id_film
    AND jouer.id_acteur = acteur.id_acteur
    AND  jouer.id_role = role.id_role
    AND genrefilm.id_film = film.id_film
    AND genrefilm.id_genre = genre.id_genre
    AND jouer.id_film = ".$id."
    ORDER BY anneeSortieFrance DESC;";

    $descFilmsStatement = connexion()->prepare($sqlDescrFilm);
    $descFilmsStatement->execute();
    return $descFilmsStatement->fetchAll();
}