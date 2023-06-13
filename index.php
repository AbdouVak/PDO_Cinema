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

        // case avec des methode qui envoie des information vers la bdd
        case "ajouterPersonne" : $ctrlAdd -> ajouterPersonne();  break;
        case "ajouterCasting" : $ctrlAdd -> ajouterCasting();  break;
        case "ajouterFilm" : $ctrlAdd -> ajouterFilm(); break;
        case "modifierTitre" : $ctrlUpdate -> modifierTitre($_GET['id']); break;
        case "modifierRealisateur" : $ctrlUpdate -> modifierRealisateur($_GET['id']); break;
        case "modifierActeur" : $ctrlUpdate -> modifierActeur($_GET['id']); break;

    }
}
