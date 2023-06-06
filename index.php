<?php 
use Controller\CinemaController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch($_GET["action"]) {
        // case avec des methode qui redirige juste vers de page 
        case "ajouterPersonnePage" : $ctrlCinema -> ajouterPersonnePage(); break;

        // case avec des methode qui envoie des information vers la page
        case "homePage" : $ctrlCinema -> listFilms(); break;
        case "description" : $ctrlCinema -> description($_GET['id']); break;
        case "ajouterCastingPage" : $ctrlCinema -> ajouterCastingPage(); break;
        case "ajouterFilmPage" : $ctrlCinema -> ajouterFilmPage(); break;

        // case avec des methode qui envoie des information vers la bdd
        case "ajouterPersonne" : $ctrlCinema -> ajouterPersonne();  break;
        case "ajouterCasting" : $ctrlCinema -> ajouterCasting();  break;
        case "ajouterFilm" : 
            $ctrlCinema -> ajouterFilm(); break;

    }
}
