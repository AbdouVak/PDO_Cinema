<?php 
use Controller\CinemaController;
use Controller\ControllerUpdateDB;
use Controller\ControllerAddDB;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlUpdate = new ControllerUpdateDB();
$ctrlAdd= new ControllerAddDB();
if(isset($_GET["action"])){
    switch($_GET["action"]) {
        // case avec des methode qui redirige juste vers de page 
        case "ajouterPersonnePage" : $ctrlCinema -> ajouterPersonnePage(); break;

        // case avec des methode qui envoie des information vers la page
        case "homePage" : $ctrlCinema -> listFilms(); break;
        case "description" : $ctrlCinema -> description($_GET['id']); break;
        case "ajouterCastingPage" : $ctrlCinema -> ajouterCastingPage(); break;
        case "ajouterFilmPage" : $ctrlCinema -> ajouterFilmPage(); break;
        case "descModificationPage" : $ctrlCinema -> descModificationPage($_GET['id']); break;
        case "filmographieRea" : $ctrlCinema -> filmographie($_GET['id'],'rea'); break;
        case "filmographieAct" : $ctrlCinema -> filmographie($_GET['id'],'act'); break;
        case "listeActeurPage" : $ctrlCinema -> listeActeurPage(); break;
        case "listeReaPage" : $ctrlCinema -> listeReaPage(); break;
        case "listeGenrePage" : $ctrlCinema -> listeGenrePage(); break;

        // case avec des methode qui envoie des information vers la bdd
        case "ajouterPersonne" : $ctrlAdd -> ajouterPersonne();  break;
        case "ajouterCasting" : $ctrlAdd -> ajouterCasting();  break;
        case "ajouterFilm" : $ctrlAdd -> ajouterFilm(); break;
        
        // case modifier information bdd
        case "modifierTitre" : $ctrlUpdate -> modifierTitre($_GET['id']); break;
        case "modifierRealisateur" : $ctrlUpdate -> modifierRealisateur($_GET['id']); break;
        case "modifierCasting" : $ctrlUpdate -> modifierCasting($_GET['id']); break;
        case "modifierAnnee" : $ctrlUpdate -> modifierAnnee($_GET['id']); break;
        case "modifierGenre" : $ctrlUpdate -> modifierGenre($_GET['id']); break;
        case "modifierSynopsis" : $ctrlUpdate -> modifierSynopsis($_GET['id']); break;
        case "modifierAffiche" : $ctrlUpdate -> modifierAffiche($_GET['id']); break;
    }
}
