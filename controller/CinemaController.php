<?php 

namespace Controller;
use Model\Connect;

class CinemaController{
    // lister les films
    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->query("SELECT titre,anneeSortieFrance
        FROM film");

        require "View/listFilms.php";
}

}