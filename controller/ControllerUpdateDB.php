<?php 

namespace Controller;
use Model\Connect;

class ControllerUpdateDB{


    
    public function modifierTitre($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        $titre = filter_var($_POST['titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($titre != Null){
            $sqlUpdateTitre="
            UPDATE `cinema`.`film` 
            SET `titre`='$titre' 
            WHERE  `id_film`=$id;";
            $updateTitreStatement = $pdo->prepare($sqlUpdateTitre);
            $updateTitreStatement->execute();
        }

        $ctrlCinema -> descModificationPage($id);
    }

    public function modifierRealisateur($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nomReal = filter_var($_POST['nomReal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenomReal = filter_var($_POST['prenomReal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($nomReal != Null && $prenomReal != Null){
            $sqlUpdateReal="
            UPDATE film
            SET id_realisateur =  (
                SELECT id_realisateur
                
                FROM realisateur,personne
                WHERE realisateur.id_personne = personne.id_personne
                
                AND nom='$nomReal'
                AND prenom='$prenomReal')
                
            WHERE  id_film=$id;";
            $updateRealStatement = $pdo->prepare($sqlUpdateReal);
            $updateRealStatement->execute();
        }
        
        $ctrlCinema -> descModificationPage($id);
    }

    public function modifierActeur($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $acteurNom = filter_var($_POST['acteurNom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $acteurPrenom = filter_var($_POST['acteurPrenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($acteurNom != Null && $acteurPrenom != Null){
            $sqlUpdateReal="
            UPDATE `cinema`.`jouer` 
            SET `id_role`=(SELECT id_role 
                FROM role
                WHERE  nomPersonnage = '$role') 
            
            WHERE  `id_film`= (
                SELECT id_film 
            FROM film 
            WHERE titre = '$id')
            AND `id_acteur`=(SELECT id_acteur
                FROM acteur,personne
                WHERE acteur.id_personne = personne.id_personne
                AND nom='$acteurNom'
                AND prenom='$acteurPrenom')

            AND `id_acteur`= (SELECT id_role 
                FROM role,jouer,acteur,personne
                WHERE jouer.id_role = role.id_role
                AND jouer.id_film = film.id_film
                AND jouer.id_acteur = acteur.id_acteur
                AND personne.id_personne = acteur.id_personne
                AND personne.nom = '$acteurNom'
                AND personne.prenom = '$acteurPrenom')
            );";
            $updateRealStatement = $pdo->prepare($sqlUpdateReal);
            $updateRealStatement->execute();
        }
        
        $ctrlCinema -> descModificationPage($id);
    }


}