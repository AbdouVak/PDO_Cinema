<?php 
use Controller\CinemaController;

spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

if(isset($_GET["action"])){
    switch($_GET["action"]) {

        case "homePage" : $ctrlCinema -> homePage(); break;
        case "listFilms" : $ctrlCinema -> listFilms(); break;
        case "description" : $ctrlCinema -> description($_GET['id']); break;
        case "ajouterPersonnePage" : $ctrlCinema -> ajouterPersonnePage(); break;

        case "ajouterPersonne" :
            $ctrlCinema -> ajouterPersonne();  break;
            
    }
}
