<?php 

namespace Controller;
use Model\Connect;

class CinemaController{


    
    public function listFilms() {
        /* Methode listFilms()
        1. Cet methode possede une requête SQl qui va chercher tout les titre 
        dans la base de données. 

        2. Puis les données seront stocke dans la variable $requete 

        3. Finalement il va rediriger vers le homePage.php
        */
        $pdo = Connect::seConnecter(); // Permet de se connecter a la base de données
        
        // \/ Etape 2     \/ Etape 1
        $requete = $pdo->query("
            SELECT titre,anneeSortieFrance,affiche,id_film
            FROM film
            ORDER BY anneeSortieFrance DESC;
        ");

        // Etape 3.
        require "view/homePage.php"; 
    }
    
    public function description($id){
        /* Methode description($id)
        1. On stocke $id dans $idFilm pour permettre dans la page description de 
        faire un bouton modifier qui va servir a la page descModification 
        De savoir qu'elle film doit être modifier

        2. On crée $ctrlCinema qui une instance de la classe CinemaController()

        3. Nous appelons la methodes recuperDescFilm($id) d'instance $ctrlCinema
        qui a pour argument $id. Cet methode envoie une requête SQL a la bdd.
        Elle va récupérer tout les info sur le film précis graçe à l'$id

        4. Stocke tout dans $requeteFilm
        */

        $idFilm = $id;// Etape 1.
        $ctrlTake = new ControllerTakeDB();
        $pdo = Connect::seConnecter();// Permet de se connecter a la base de données

        // \/ Etape 4       \/ Etape 3  
        $requeteFilm = $ctrlTake ->  recuperDescFilm($id);

        // \/ Etape 4       \/ Etape 3         \/ avec meth recuperGenreFilm() 
        $requeteGenre = $ctrlTake -> recuperGenreFilm($id);
        
        // \/ Etape 4        \/ Etape 3        \/  avec meth recuperCastingFilm()
        $requeteCasting = $ctrlTake -> recuperCastingFilm($id);

        
        require "view/descriptionPage.php"; // va rediriger vers la page description
    }

    public function descModificationPage($id){
        $idFilm = $id;// Etape 1.
        $ctrlCinema = new CinemaController();// Etape 2.
        $ctrlTake = new ControllerTakeDB();
        $pdo = Connect::seConnecter(); // se connect a la base de données
        

        $requeteFilm = $ctrlTake ->  recuperDescFilm($id);

        $requeteGenreFilm = $ctrlTake -> recuperGenreFilm($id);

        $requeteGenre = $ctrlTake -> recuperGenre();
        
        $requeteCasting = $ctrlTake -> recuperCastingFilm($id);

        $requeteReal = $ctrlTake -> recuperRealisateur();

        $requeteActeur = $ctrlTake -> recuperActeur();

        $requeteRole = $ctrlTake ->recuperRole();

        require "view/descModificationPage.php"; // va rediriger vers la page description
    }
    
    public function ajouterPersonnePage() {  
        /* Methode ajouterPersonnePage() 
        redirige a la page d'ajout d'un personnage 
        */ 
        require "view/ajouterPersonnePage.php"; // va rediriger vers la page ajouterPersonne
    }

    public function ajouterCastingPage() {
         /* Methode ajouterCastingPage()
        1. On envoie une requête SQL à la bdd
        2. On stocke la réponse d'une requête SQL dans une variale
        */
        $pdo = Connect::seConnecter(); // On se connect a la base de données
        $ctrlTake = new ControllerTakeDB();
        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les titre dans la bdd) 
        $requeteFilm = $ctrlTake -> recuperTitre();
        
        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les nom, prenom dans la bdd) 
        $requeteActeurNom =$pdo->query( "
        SELECT nom
        FROM personne,acteur
        WHERE personne.id_personne = acteur.id_personne");
        
        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les nom, prenom dans la bdd) 
        $requeteActeurPrenom =$pdo->query( "
        SELECT prenom
        FROM personne,acteur
        WHERE personne.id_personne = acteur.id_personne");

        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les role dans la bdd) 
        $requeteRole = $ctrlTake -> recuperRole();

        require "view/ajouterCastingPage.php"; // redirige vers la page ajouterCastingPage
    }


    public function ajouterFilmPage() {
        /* Methode ajouterFilmPage()*/
        $pdo = Connect::seConnecter(); // On se connect a la base de données
        $ctrlTake = new ControllerTakeDB();

        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les nom et prenom des réalisateur dans la bdd) 
        $requeteRealNom =$pdo->query( "
        SELECT nom
        FROM personne,realisateur
        WHERE personne.id_personne = realisateur.id_personne");

        $requeteRealPrenom =$pdo->query( "
        SELECT prenom
        FROM personne,realisateur
        WHERE personne.id_personne = realisateur.id_personne");
        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les nom des genres dans la bdd) 
        $requeteGenre = $ctrlTake -> recuperGenre();
        
        require "view/ajouterFilmPage.php";// redirige vers la page ajouterFilmPage
    }

    public function filmographie($id,$metier) {
        $pdo = Connect::seConnecter(); // On se connect a la base de données
        if($metier == 'act'){
            $requeteFilm = $pdo->query("
            SELECT titre,anneeSortieFrance,nomPersonnage,affiche
            FROM role,jouer,film,acteur
            WHERE role.id_role = jouer.id_role
            AND film.id_film = jouer.id_film
            AND acteur.id_acteur = jouer.id_acteur
            AND acteur.id_acteur = $id");
            
        }elseif($metier == 'rea'){
            $requeteFilm = $pdo->query("
            SELECT titre,anneeSortieFrance,affiche
            FROM film
            WHERE film.id_realisateur = $id");
        }

        require "view/filmographiePage.php";// redirige vers la page ajouterFilmPage
    }

    public function listeActeurPage() {
        $ctrlTake = new ControllerTakeDB;
        $pdo = Connect::seConnecter(); // On se connect a la base de données
        $listeActeur = $ctrlTake ->recuperActeur();

        echo 'LISTE DES ACTEURS<br>';
        foreach($listeActeur as $acteur){
            echo '#'.$acteur['nom'].'<br>';
        }

        
    }
}