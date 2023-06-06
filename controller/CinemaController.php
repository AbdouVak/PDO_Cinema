<?php 

namespace Controller;
use Model\Connect;

class CinemaController{
    // ------------------------------------------------------  case avec des methode qui redirige juste vers de page ------------------------------------------------------
    // obtien les affiche, titre et année de sortie films
    public function listFilms() {
        $pdo = Connect::seConnecter();// se connect a la base de données

        // requete pour recupere le titre et nom film
        $requete = $pdo->query("
            SELECT titre,anneeSortieFrance,affiche,id_film
            FROM film
            ORDER BY anneeSortieFrance DESC;
        ");
        
        require "view/homePage.php"; // va rediriger vers le homePage
    }

    // ------------------------------------------------------ case avec des methode qui envoie des information vers la page ------------------------------------------------------
    // redirige a la page d'ajout d'un personnage
    public function ajouterPersonnePage() {   
        require "view/ajouterPersonnePage.php"; // va rediriger vers la page ajouterPersonne
    }

    // obtien les info d'un film
    public function description($id){
        // se connect a la base de données
        $pdo = Connect::seConnecter();

        // requete pour recupere le titre année de sortie, l'affiche, le synopsis,nom et prenom du realisateur
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
        $filmsStatement->execute(["id" => $id]); // permet de recupere les enregistrement du film grace au id en parametre de la fonction
        $requeteFilm = $filmsStatement->fetchAll();

        // requete pour recupere le genre
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

        // requete pour recupere les nom et prenom de tous les acteurs
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

        // va rediriger vers la page description
        require "view/description.php";
    }

    // redirige a la page d'ajout de personnage
    public function ajouterCastingPage() {
        $pdo = Connect::seConnecter();

        // requête pour recupere tous les titre de film
        $sqlCasting = "
        SELECT titre 
        FROM film";
        
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute();
        $requeteFilm = $castingStatement->fetchAll();

        // requête pour recupere tous les nom de personnage des role
        $sqlRole = "
        SELECT nomPersonnage 
        FROM role";
        
        $roleStatement = $pdo->prepare($sqlRole);
        $roleStatement->execute();
        $requeteRole = $roleStatement->fetchAll();

        // requête pour recupere tous les nom et prenom de toute les personne
        $sqlCasting = "
        SELECT nom,prenom 
        FROM personne";
        
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute();
        $requeteActeur = $castingStatement->fetchAll();

        require "view/ajouterCastingPage.php"; // redirige vers la page ajouterCastingPage
    }

    // redirige a la page d'ajout d'un film
    public function ajouterFilmPage() {
        $pdo = Connect::seConnecter();
        // requête pour recupere tous les titre de film
        $sqlReal = "
        SELECT nom,prenom 
        FROM personne,realisateur
        WHERE personne.id_personne = realisateur.id_personne";
        
        $realStatement = $pdo->prepare($sqlReal);
        $realStatement->execute();
        $requeteReal = $realStatement->fetchAll();

        $pdo = Connect::seConnecter();
        // requête pour recupere tous les titre de film
        $sqlGenre = "
        SELECT genreLibelle
        FROM genre";
        
        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute();
        $requeteGenre = $genreStatement->fetchAll();
        require "view/ajouterFilmPage.php";
    }

    // ------------------------------------------------------  case avec des methode qui envoie des information vers la bdd ------------------------------------------------------
    // ajoue a la bdd une personne
    public function ajouterPersonne() {
        $pdo = Connect::seConnecter();
        // requête pour ajouter une personne à la bdd 
        $sqlPersonne = "
        INSERT INTO `cinema`.`personne` ( `nom`, `prenom`, `sexe`, `dateNaissance`) 
        VALUES ('".htmlspecialchars($_POST['nom'], ENT_QUOTES)."', '".htmlspecialchars($_POST['prenom'], ENT_QUOTES)."', '".htmlspecialchars($_POST['sexe'], ENT_QUOTES)."', '".htmlspecialchars($_POST['dateNaissance'], ENT_QUOTES)."');
        ";

        $personnesStatement = $pdo->prepare($sqlPersonne);
        $personnesStatement->execute();

        // en fonction de si on a choisie acteur ou realisateur ajoutere la personne en tant que telle
        if($_POST['metier']== 'acteur'){
            // requête pour ajouter la personne dans la table acteur
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
            // requête pour ajouter la personne dans la table realisasateur
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
        
        require "view/ajouterPersonnePage.php"; // redirige vers la page ajouterPersonnePage
    }
    
    // ajoute ajoute un acteur avec son role d'un dans la bdd
    public function ajouterCasting() {
        $pdo = Connect::seConnecter();
        // requête pour ajouter a la table jouer l'acteur avec son role dans un film
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

        require "view/ajouterCastingPage.php"; // redirige vers la page ajouterCastingPage
    }

    // ajoute ajoute un acteur avec son role d'un dans la bdd
    public function ajouterRole() {
        $pdo = Connect::seConnecter();
        // requete pour ajouter un role
        $sqlRole= "
        INSERT INTO `cinema`.`role` (`nomPersonnage`) 
        VALUES ('".htmlspecialchars($_POST['role'], ENT_QUOTES)."');
        ";
        $roleStatement = $pdo->prepare($sqlRole);
        $roleStatement->execute();
        require "view/ajouterCastingPage.php";// redirige vers la page ajouterCastingPage
    }

    // ajoute ajoute un acteur avec son role d'un dans la bdd
    public function ajouterGenre() {
        $pdo = Connect::seConnecter();
        // requete pour ajouter un role
        $sqlGenre= "
        INSERT INTO `cinema`.`genre` (`genreLibelle`) 
        VALUES ('".htmlspecialchars($_POST['genre'], ENT_QUOTES)."');
        ";
        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute();
        require "view/ajouterCastingPage.php";// redirige vers la page ajouterCastingPage
    }

    // ajoute ajoute un acteur avec son role d'un dans la bdd
    public function ajouterFilm() {
        $pdo = Connect::seConnecter();
        // requete pour ajouter un role
        $sqlGenre= "
        INSERT INTO `cinema`.`film` (`titre`, `anneeSortieFrance`, `duree`, `id_realisateur`) 
        SELECT '".htmlspecialchars($_POST['titre'], ENT_QUOTES)."', '".htmlspecialchars($_POST['anneeSortie'], ENT_QUOTES)."', '".htmlspecialchars($_POST['duree'], ENT_QUOTES)."',id_realisateur
        FROM realisateur,personne
        WHERE realisateur.id_personne = personne.id_personne 
        AND nom = '".htmlspecialchars($_POST['realisateurNom'], ENT_QUOTES)."'
        AND prenom = '".htmlspecialchars($_POST['realisateurPrenom'], ENT_QUOTES)."'
        ";

        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute();

        $sqlGenre= "
        INSERT INTO `cinema`.`genre` (`genreLibelle`) 
        VALUES ('".htmlspecialchars($_POST['genre'], ENT_QUOTES)."');
        ";
        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute();

        // requete pour ajouter un genre au film
        $sqlGenreFilm= "
        INSERT INTO `cinema`.`genrefilm` (`id_film`, `id_genre`)
        SELECT film.id_film,genre.id_genre
        FROM film,genre
        WHERE film.titre = '".htmlspecialchars($_POST['titre'], ENT_QUOTES)."'
        AND genre.genreLibelle ='".htmlspecialchars($_POST['genre'], ENT_QUOTES)."'
        ";

        $genreFilmStatement = $pdo->prepare($sqlGenreFilm);
        $genreFilmStatement->execute();

        require "view/ajouterFilmPage.php";// redirige vers la page ajouterCastingPage
    }

}

