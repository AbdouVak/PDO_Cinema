<?php 

namespace Controller;
use Model\Connect;

class CinemaController{

    // lister les films
    public function listFilms() {
        // se connect a la base de données
        $pdo = Connect::seConnecter();
        // requete pour recuupere le titre et nom film
        $requete = $pdo->query("
            SELECT titre,anneeSortieFrance,affiche,id_film
            FROM film
            ORDER BY anneeSortieFrance DESC;
        ");
        // va rediriger vers le listFilm
        require "view/listFilms.php";
    }

    // redirige a la page d'accueille
    public function homePage() {
        // va rediriger vers le homepage (acceuil)
        require "view/homePage.php";
    }

    public function description($id){
        $pdo = Connect::seConnecter();

        $sqlFilm = "
        SELECT titre,anneeSortieFrance,affiche,synopsis,genreLibelle,nom,prenom

        FROM film ,realisateur,acteur ,personne,genre,genrefilm
        
        WHERE film.id_realisateur = realisateur.id_realisateur
        
        AND realisateur.id_personne = personne.id_personne
        AND genrefilm.id_film = film.id_film
        AND genrefilm.id_genre = genre.id_genre
        
        AND film.id_film = :id
        
        GROUP BY genre.id_genre
        ORDER BY anneeSortieFrance DESC

        ";

        $filmsStatement = $pdo->prepare($sqlFilm);
        $filmsStatement->execute(["id" => $id]);
        $requeteFilm = $filmsStatement->fetchAll();

        $sqlCasting = "
        SELECT nom,prenom, nomPersonnage

        FROM film ,acteur,personne ,jouer, role
        WHERE film.id_film = jouer.id_film
        AND jouer.id_acteur = acteur.id_acteur
        AND acteur.id_personne = personne.id_personne
        AND role.id_role = jouer.id_role


        AND jouer.id_film = :id
        ORDER BY anneeSortieFrance DESC;
        ";

        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute(["id" => $id]);
        $requeteCasting = $castingStatement->fetchAll();

        
        require "view/description.php";
    }

    public function ajouterPersonne() {
        // va rediriger vers le homepage (acceuil)
        require "view/ajouterPersonne.php";
    }
}

