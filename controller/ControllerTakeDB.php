<?php 

namespace Controller;
use Model\Connect;

class ControllerTakeDB{

    /* METHODE recuperGenreFilm($id)
        execute une requête SQL qui récuper le genre du film. la fonction a pour parametre $id.
        graçe à ça en pourra l'utiliser pour trouver le film dans la requête
    */
    public function recuperGenreFilm($id) {
        $pdo = Connect::seConnecter(); // se connecte  a la bdd

        $sqlGenre = "
        SELECT genreLibelle
        FROM film ,genre,genrefilm 
        WHERE film.id_film = genrefilm.id_film
        AND genrefilm.id_genre = genre.id_genre
        AND film.id_film = :id";
        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute(["id" => $id]);
        return $genreStatement->fetchAll();
    }
    
    /* METHODE recuperCastingFilm($id)
        execute une requête SQL qui récuper le casting du film. la fonction a pour parametre $id.
        graçe à ça en pourra l'utiliser pour trouver le film dans la requête
    */
    public function recuperCastingFilm($id) {
        $pdo = Connect::seConnecter();
        // requete pour recupere le genre
        $sqlCasting = "
        SELECT nom,prenom, nomPersonnage,acteur.id_acteur
        FROM film ,acteur,personne ,jouer, role
        WHERE film.id_film = jouer.id_film
        AND jouer.id_acteur = acteur.id_acteur
        AND acteur.id_personne = personne.id_personne
        AND role.id_role = jouer.id_role
        AND jouer.id_film = :id;";
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute(["id" => $id]);
        return $castingStatement->fetchAll();
    }

    /* METHODE recuperDescFilm($id)
        execute une requête SQL qui récuper le genre du film. la fonction a pour parametre $id.
        graçe à ça en pourra l'utiliser pour trouver le film dans la requête
    */
    public function recuperDescFilm($id) {
        $pdo = Connect::seConnecter();
        // requete pour recupere le genre
        $sqlFilm = "
        SELECT titre,anneeSortieFrance,affiche,synopsis,nom,prenom,film.id_realisateur
        FROM film ,realisateur,acteur ,personne 
        WHERE film.id_realisateur = realisateur.id_realisateur
        AND realisateur.id_personne = personne.id_personne
        AND film.id_film = :id
        GROUP BY film.id_film";
        $filmsStatement = $pdo->prepare($sqlFilm);
        $filmsStatement->execute(["id" => $id]);
        return $filmsStatement->fetchAll();
    }

    
    public function recuperRealisateur() {
        $pdo = Connect::seConnecter();

        $sqlReal = "
        SELECT nom,prenom
        FROM personne,realisateur
        WHERE personne.id_personne = realisateur.id_personne;";
        $realStatement = $pdo->prepare($sqlReal);
        $realStatement->execute();
        return $realStatement->fetchAll();
    }

    public function recuperActeur() {
        $pdo = Connect::seConnecter();

        $sqlActeur = "
        SELECT nom,prenom
        FROM personne,acteur
        WHERE personne.id_personne = acteur.id_personne;";
        $acteurStatement = $pdo->prepare($sqlActeur);
        $acteurStatement->execute();
        return $acteurStatement->fetchAll();
    }

    public function recuperGenre() {
        $pdo = Connect::seConnecter();

        $sqlGenre = "
        SELECT genreLibelle
        FROM genre";
        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute();
        return $genreStatement->fetchAll();
    }

    public function recuperTitre() {
        $pdo = Connect::seConnecter();

        $sqlTitre = "
        SELECT titre
        FROM film";
        $titreStatement = $pdo->prepare($sqlTitre);
        $titreStatement->execute();
        return $titreStatement->fetchAll();
    }

    public function recuperRole() {
        $pdo = Connect::seConnecter();

        $sqlTitre = "
        SELECT nomPersonnage
        FROM role";
        $titreStatement = $pdo->prepare($sqlTitre);
        $titreStatement->execute();
        return $titreStatement->fetchAll();
    }


}
