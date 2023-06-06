<?php 

namespace Controller;
use Model\Connect;

class CinemaController{

    // obtien les affiche, titre et année de sortie films
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

    // obtien les info d'un film
    public function description($id){
        $pdo = Connect::seConnecter();

        $sqlFilm = "
        SELECT titre,anneeSortieFrance,affiche,synopsis,nom,prenom

        FROM film ,realisateur,acteur ,personne
        
        WHERE film.id_realisateur = realisateur.id_realisateur
        
        AND realisateur.id_personne = personne.id_personne
        
        AND film.id_film = :id
        GROUP BY film.id_film
        ORDER BY anneeSortieFrance DESC

        ";

        $filmsStatement = $pdo->prepare($sqlFilm);
        $filmsStatement->execute(["id" => $id]);
        $requeteFilm = $filmsStatement->fetchAll();

        $sqlGenre = "
        SELECT genreLibelle

        FROM film ,genre,genrefilm 
        WHERE film.id_film = genrefilm.id_film
        AND genrefilm.id_genre = genre.id_genre
        
        AND film.id_film = :id
        ";

        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute(["id" => $id]);
        $requeteGenre = $genreStatement->fetchAll();

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

    // redirige a la page d'ajout d'un personnage
    public function ajouterPersonnePage() {
        // va rediriger vers la page ajouterPersonne
        require "view/ajouterPersonnePage.php";
    }

    // ajoue a la bdd une personne
    public function ajouterPersonne() {
        $pdo = Connect::seConnecter();
        
        $sqlPersonne = "
        INSERT INTO `cinema`.`personne` ( `nom`, `prenom`, `sexe`, `dateNaissance`) 
        VALUES ('".htmlspecialchars($_POST['nom'], ENT_QUOTES)."', '".htmlspecialchars($_POST['prenom'], ENT_QUOTES)."', '".htmlspecialchars($_POST['sexe'], ENT_QUOTES)."', '".htmlspecialchars($_POST['dateNaissance'], ENT_QUOTES)."');
        ";
        $personnesStatement = $pdo->prepare($sqlPersonne);
        $personnesStatement->execute();

        if($_POST['metier']== 'acteur'){
            $sqlActeur = "
            INSERT INTO `cinema`.`acteur`(`id_personne`)
            SELECT id_personne 
            FROM personne
            WHERE nom = '".htmlspecialchars($_POST['nom'], ENT_QUOTES)."';
            AND prenom = '".htmlspecialchars($_POST['prenom'], ENT_QUOTES)."';
            ";
            $acteurStatement = $pdo->prepare($sqlActeur);
            $acteurStatement->execute();
        }elseif($_POST['metier']== 'realisateur'){
            $sqlReal = "
            INSERT INTO `cinema`.`realisateur`(`id_personne`)
            SELECT id_personne 
            FROM personne
            WHERE nom = '".htmlspecialchars($_POST['nom'], ENT_QUOTES)."';
            AND prenom = '".htmlspecialchars($_POST['prenom'], ENT_QUOTES)."';
            ";
            $realStatement = $pdo->prepare($sqlReal);
            $realStatement->execute();
        }
        

        require "view/ajouterPersonnePage.php";
    }

    // redirige a la page d'ajout de personnage
    public function ajouterCastingPage() {
        $pdo = Connect::seConnecter();
        
        $sqlCasting = "
        SELECT titre 
        FROM film";
        
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute();
        $requeteFilm = $castingStatement->fetchAll();

        $sqlRole = "
        SELECT nomPersonnage 
        FROM role";
        
        $roleStatement = $pdo->prepare($sqlRole);
        $roleStatement->execute();
        $requeteRole = $roleStatement->fetchAll();
        
        $sqlCasting = "
        SELECT nom,prenom 
        FROM personne";
        
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute();
        $requeteActeur = $castingStatement->fetchAll();

        require "view/ajouterCastingPage.php";
    }

    // ajoute ajoute un acteur avec son role d'un dans la bdd
    public function ajouterCasting() {
        $pdo = Connect::seConnecter();
        
        $sqlCasting = "
        INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`)
        SELECT id_film AS idFilm,id_acteur AS idActeur, id_role AS idRole

        FROM film,acteur,role

        HAVING idFilm IN (
            SELECT id_film 
            FROM film 
            WHERE titre = '".htmlspecialchars($_POST['film'], ENT_QUOTES)."')

        AND idRole IN (
            SELECT id_role 
            FROM role,acteur 
            WHERE role.id_role
            AND nomPersonnage = '".htmlspecialchars($_POST['role'], ENT_QUOTES)."')
            
        AND idActeur IN (
            SELECT id_acteur 
            FROM acteur,personne 
            WHERE acteur.id_personne = personne.id_personne
            AND personne.prenom = '".htmlspecialchars($_POST['acteurPrenom'], ENT_QUOTES)."'
            AND personne.nom = '".htmlspecialchars($_POST['acteurNom'], ENT_QUOTES)."')
        ";
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute();
        require "view/ajouterCastingPage.php";
    }


}

