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

    public function modifierCasting($id) {
        $ctrlCinema = new CinemaController();
        $ctrlTake = new ControllerTakeDB();
        $pdo = Connect::seConnecter();
        
        echo $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        echo $acteurNom = filter_var($_POST['acteurNom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        echo $acteurPrenom = filter_var($_POST['acteurPrenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        
        $requeteCasting = $ctrlTake ->recuperCastingFilm($id);

        foreach($requeteCasting as $casting){
            if($casting['prenom'] == $acteurPrenom && $casting['nom'] == $acteurNom && $casting['nom'] != $role){
                $sqlUpdateRole="
                UPDATE `cinema`.`jouer` 
            
                SET `id_role`=(SELECT id_role 
                    FROM role
                    WHERE  nomPersonnage = '$role') 
                                    
                WHERE	`id_film`= $id
        
                AND	`id_acteur`=(SELECT acteur.id_acteur
                    FROM acteur,personne
                    WHERE acteur.id_personne = personne.id_personne
                    AND prenom='$acteurPrenom'
                    AND nom='$acteurNom');";

                $updateRoleStatement = $pdo->prepare($sqlUpdateRole);
                $updateRoleStatement->execute();
            }elseif($casting['prenom'] != $acteurPrenom && $casting['nom'] != $acteurNom && $casting['nomPersonnage'] == $role){
                echo 'qf';
                $sqlUpdateActeur="
                UPDATE `cinema`.`jouer` 
                SET `id_acteur`=(SELECT acteur.id_acteur
                    FROM acteur,personne
                        WHERE acteur.id_personne = personne.id_personne
                    AND nom='$acteurNom'
                    AND prenom='$acteurPrenom')
                    
                WHERE  `id_film`= 3
    
                AND `id_role`=(SELECT role.id_role 
                    FROM role
                        WHERE nomPersonnage = '$role');";
                $updateActeurStatement = $pdo->prepare($sqlUpdateActeur);
                $updateActeurStatement->execute();
            }
        }
        
        $ctrlCinema -> descModificationPage($id);
    }

    public function modifierAnnee($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        $anneeSortie = filter_var($_POST['anneeSortie'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($anneeSortie != Null){
            $sqlUpdatAnnee="
            UPDATE `cinema`.`genrefilm` 
            SET `id_genre`='2' 
            WHERE  `id_film`=1 
            AND `id_genre`=1;";
            $updateAnneeStatement = $pdo->prepare($sqlUpdatAnnee);
            $updateAnneeStatement->execute();
        }

        $ctrlCinema -> descModificationPage($id);
    }

    public function modifierGenre($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        echo $genre = filter_var($_POST['genre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sqlGenre = '
            SELECT genreLibelle,genrefilm.id_film
            FROM genre,genrefilm,film
            WHERE genre.id_genre = genrefilm.id_genre
            AND genrefilm.id_film = film.id_film
            AND film.id_film = '.$id.'';
        $updateGenreStatement = $pdo->prepare($sqlGenre);
        $updateGenreStatement->execute();
        $requeteGenre = $updateGenreStatement->fetchAll();
        var_dump($requeteGenre);
        foreach($requeteGenre as $genreFilm){
           if($genreFilm['genreLibelle']!= $genre && $genreFilm['id_film'] == $id){
                $sqlUpdatGenre="
                UPDATE `cinema`.`genrefilm` 
                SET `id_genre`=(SELECT id_genre
                    FROM genre
                    WHERE genre.genreLibelle= '$genre')
                    
                WHERE  `id_film`=$id;";
                $updateGenreStatement = $pdo->prepare($sqlUpdatGenre);
                $updateGenreStatement->execute();
            } 
        }
        

        $ctrlCinema -> descModificationPage($id);
    }

    public function modifierSynopsis($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        $synopsis = filter_var($_POST['synopsis'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if($synopsis != Null){
            $sqlUpdateSynopsis="
            UPDATE `cinema`.`film` 
            SET `synopsis`='$synopsis' 
            WHERE  `id_film`=$id;";
            $updateSynopsisStatement = $pdo->prepare($sqlUpdateSynopsis);
            $updateSynopsisStatement->execute();
        }

        $ctrlCinema -> descModificationPage($id);
    }

    public function modifierAffiche($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        // filtre pour verifier que le fichier est bien une image puis le stock
        $affiche = 0;
        if(isset($_FILES['file'])){
            $tmpName = $_FILES['file']['tmp_name'];
            $name = $_FILES['file']['name'];    //stock le nom de l'image
            $size = $_FILES['file']['size'];    //stock la valeur de la taille de l'image
            $error = $_FILES['file']['error'];  //stock le numero de l'erreur de l'image
            $tabExtension = explode('.', $name);
            $extension = strtolower(end($tabExtension));    //change l'extension en miniscule
            $extensions = ['jpg', 'png', 'jpeg', 'gif'];    //crée une table avec les extention
            $maxSize = 400000;                              //Taille max que l'on accepte

            //verifie si les extention sont correct,que la taille est en dessous de la taille max et qu'il n'y a pas d'erreur
            if(in_array($extension, $extensions) && $size <= $maxSize && $error == 0){

                $uniqueName = uniqid('', true);                     // uniqid génère quelque chose comme ca : 5f586bf96dcd38.73540086
                $file = $uniqueName.".".$extension;                 // $file = 5f586bf96dcd38.73540086.jpg
                move_uploaded_file($tmpName, './public/IMG/'.$file);    // deplace le fichier avec un nom unique dans le dossier upload
                $affiche = $file;                         // Ajoute le nom de l'image avec son extension dans $_SESSION['image']
            }
        }else{
            echo 'aucune image';
        }

        if($affiche != Null){
            $sqlUpdateAffiche="
            UPDATE `cinema`.`film` 
            SET `affiche`='$affiche' 
            WHERE  `id_film`=$id;";
            $updateAfficheStatement = $pdo->prepare($sqlUpdateAffiche);
            $updateAfficheStatement->execute();
        }else{
            echo 'aucune image ajouté';
        }

        
        
        $ctrlCinema -> descModificationPage($id);
    }
}