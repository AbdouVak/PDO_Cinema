<?php 

namespace Controller;
use Model\Connect;

class CinemaController{

    // FONCTION QUI RECUPERE DES ELEMENT A LA BDD POUR ENVOIER AU VUE [!]
    /* Methode listFilms()
        1. Cet methode possede une requête SQl qui va chercher tout les titre 
        dans la base de données. 

        2. Puis les données seront stocke dans la variable $requete 

        3. Finalement il va rediriger vers le homePage.php
    */
    public function listFilms() {
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
    public function description($id){
        
        $idFilm = $id;// Etape 1.
        $ctrlCinema = new CinemaController();// Etape 2.
        $pdo = Connect::seConnecter();// Permet de se connecter a la base de données

        // \/ Etape 4       \/ Etape 3  
        $requeteFilm = $ctrlCinema ->  recuperDescFilm($id);

        // \/ Etape 4       \/ Etape 3         \/ avec meth recuperGenreFilm() 
        $requeteGenre = $ctrlCinema -> recuperGenreFilm($id);
        
        // \/ Etape 4        \/ Etape 3        \/  avec meth recuperCastingFilm()
        $requeteCasting = $ctrlCinema -> recuperCastingFilm($id);

        
        require "view/descriptionPage.php"; // va rediriger vers la page description
    }
    

    /* Methode descModificationPage($id)
        1. On stocke $id dans $idFilm pour permettre dans la page description de 
        faire un bouton modifier qui va servir a la page descModification 
        De savoir qu'elle film doit être modifier

        2. On crée $ctrlCinema qui une instance de la classe CinemaController()

        3. Nous appelons la methodes recuperDescFilm($id) d'instance $ctrlCinema
        qui a pour argument $id. Cet methode envoie une requête SQL a la bdd.
        Elle va récupérer tout les info sur le film précis graçe à l'$id

        4. Stocke tout dans $requeteFilm

        5.On crée une variable $requeteReal, elle contiendra une requete SQL qui a pour 
        but de recupérer tout les nom et prenom des réalisateur
    */
    public function descModificationPage($id){
        $idFilm = $id;// Etape 1.
        $ctrlCinema = new CinemaController();// Etape 2.
        $pdo = Connect::seConnecter(); // se connect a la base de données
        
        // \/ Etape 4       \/ Etape 3  
        $requeteFilm = $ctrlCinema ->  recuperDescFilm($id);

        // \/ Etape 4       \/ Etape 3         \/ avec meth recuperGenreFilm() 
        $requeteGenre = $ctrlCinema -> recuperGenreFilm($id);
        
        // \/ Etape 4        \/ Etape 3        \/  avec meth recuperCastingFilm()
        $requeteCasting = $ctrlCinema -> recuperCastingFilm($id);
        
        // \/ Etape 5
        $requeteReal = $pdo->query("
            SELECT nom,prenom 
            FROM personne,realisateur
            WHERE personne.id_personne = realisateur.id_personne
        ");

        require "view/descModificationPage.php"; // va rediriger vers la page description
    }


    /* Methode ajouterPersonnePage() 
        redirige a la page d'ajout d'un personnage 
    */
    public function ajouterPersonnePage() {   
        require "view/ajouterPersonnePage.php"; // va rediriger vers la page ajouterPersonne
    }


    /* Methode ajouterCastingPage()
        1. On envoie une requête SQL à la bdd
        2. On stocke la réponse d'une requête SQL dans une variale
    */
    public function ajouterCastingPage() {
        $pdo = Connect::seConnecter(); // On se connect a la base de données

        // \/ Etape 2     \/ Etape 1 (la requête recupere tout les titre dans la bdd) 
        $requeteFilm = $pdo->query( "
        SELECT titre 
        FROM film");
        
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
        $requeteRole = $pdo->query( "
        SELECT nomPersonnage
        FROM role");

        require "view/ajouterCastingPage.php"; // redirige vers la page ajouterCastingPage
    }

    // /!\ faire le commentaire 
    /* Methode ajouterFilmPage()
        
    */
    public function ajouterFilmPage() {
        $pdo = Connect::seConnecter(); // On se connect a la base de données

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
        $requeteGenre = $pdo->query( "
        SELECT genreLibelle
        FROM genre");

        require "view/ajouterFilmPage.php";// redirige vers la page ajouterFilmPage
    }


    /* Methode ajouterPersonne()
        1. executer une requête SQL qui va ajouter une personne. On mettra dans VALUES les variable 
        qu'on a recu du formulaires de ajouterPersonnePage et qu'on a filtré.
        
        2. On crée une condition if si le metier est acteur alors execute Etape 3 sinon si le metier est réalisateur
        alors execute Etape 4
        
        3. executer une requête SQL qui va ajouter une personne en tant qu'acteur
        
        4. executer une requête SQL qui va ajouter une personne en tant que réalisateur
    */
    public function ajouterPersonne() {
        $pdo = Connect::seConnecter(); // On se connect a la base de données

        // Filtre les caracter spéciaux pour eviter d'injecter du code
        $nom = filter_var($_POST['nom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sexe = filter_var($_POST['sexe'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $dateNaissance = filter_var($_POST['dateNaissance'], FILTER_SANITIZE_NUMBER_INT);
        $metier = filter_var($_POST['metier'], FILTER_SANITIZE_NUMBER_INT);

        // \/ Etape 1
        $sqlPersonne = "
        INSERT INTO `cinema`.`personne` ( `nom`, `prenom`, `sexe`, `dateNaissance`) 
        VALUES ('$nom', '$prenom ', '$sexe', '$dateNaissance');";
        $personnesStatement = $pdo->prepare($sqlPersonne);
        $personnesStatement->execute();

        // \/ Etape 2
        if($_POST['metier'] == 'acteur'){

            // \/ Etape 3
            $sqlActeur = "
            INSERT INTO `cinema`.`acteur`(`id_personne`)
            SELECT id_personne 
            FROM personne
            WHERE nom = '$nom';
            AND prenom = '$prenom';";
            $acteurStatement = $pdo->prepare($sqlActeur);
            $acteurStatement->execute();

        // \/ Etape 2.5
        }elseif($_POST['metier']== 'realisateur'){

            // \/ Etape 4
            $sqlReal = "
            INSERT INTO `cinema`.`realisateur`(`id_personne`)
            SELECT id_personne 
            FROM personne
            WHERE nom = '".$nom."';
            AND prenom = '".$prenom."';";
            $realStatement = $pdo->prepare($sqlReal);
            $realStatement->execute();
        }
        
        require "view/ajouterPersonnePage.php"; // redirige vers la page ajouterPersonnePage
    }
    
    // FONCTION QUI AJOUTE DES ELEMENT A LA BDD [!]
    /* Methode ajouterCasting()
        1. executer une requête SQL qui va recuperer tout les information qui nous permttra de savoir si le casting
        n'exitse pas déjà. Ce qui signifie que la réoinse contiendra des info si l'acteur ne joue pas déjà le role dans le film
        
        2. Condition if qui verifie que la requête de l'etape 1 ne contient rien pour executer l'étape 3
        sinon affiche "casting deja fait"
        
        3.1. Nous appelons la methodes ajouterRole() d'instance $ctrlCinema.Cet methode envoie une requête SQL a la bdd.
        Elle va ajouté le role dans la bdd sinon afficher un message que le role a déjà été ajouté

        3.2 executer une requête SQL qui va ajouter le casting à la bdd.
        -La requête insere dans la bdd l'id_film, id_acteur, id_role. 
        -Pour obtenir l'id nous allons Faire un SELECT de ces id.
        -Chaque id aura un ALIAS 
        -Ces ALIAS nous permtra avec HAVING de executer des sous requête.
        -Ces sous requête filterons en fonction de nos variables.Ex: la sous requete pour le film nous donnera 
        l'id du film en fonction du nom du film dans le WHERE


    */
    public function ajouterCasting() {
        $pdo = Connect::seConnecter(); // On se connect a la base de données
        $ctrlCinema = new CinemaController();// Etape 2.
        // Filtre les caracter spéciaux pour eviter d'injecter du code
        $film = filter_var($_POST['film'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $role = filter_var($_POST['role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $acteurPrenom = filter_var($_POST['acteurPrenom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $acteurNom = filter_var($_POST['acteurNom'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        // \/ Etape 1
        $requeteCheckCasting = "
        SELECT jouer.id_acteur, jouer.id_film,jouer.id_role
        FROM jouer,acteur,role,personne,film
        WHERE jouer.id_acteur = acteur.id_acteur
        AND acteur.id_personne = personne.id_personne
        AND jouer.id_role = role.id_role
        AND jouer.id_film = film.id_film

        AND nom = '$acteurPrenom'
        AND prenom = '$acteurPrenom'
        AND titre = '$film'
        AND nomPersonnage = '$role';";

        $CheckCastingStatement = $pdo->prepare($requeteCheckCasting);
        $CheckCastingStatement->execute();
        $CheckCasting =  $CheckCastingStatement->fetchAll();

        // \/ Etape 2
        if($CheckCasting == null){
            // \/ Etape 3.1
            $checkRole = $ctrlCinema -> ajouterRole($role);
            if($role == "role deja ajouter"){
                echo $checkRole;
            }
            // \/ Etape 3.1
            $sqlCasting = "
            INSERT INTO `cinema`.`jouer` (`id_film`, `id_acteur`, `id_role`)
    
            SELECT id_film AS idFilm,id_acteur AS idActeur, id_role AS idRole
            FROM film,acteur,role
    
            HAVING idFilm IN (
                SELECT id_film 
            FROM film 
                WHERE titre = '$film')
    
            AND idRole IN (
            SELECT id_role 
            FROM role
            WHERE  nomPersonnage = '$role')
                        
            AND idActeur IN (
            SELECT id_acteur 
                FROM acteur,personne 
            WHERE acteur.id_personne = personne.id_personne
            AND personne.prenom = '$acteurPrenom'
            AND personne.nom = '$acteurNom')";
            $castingStatement = $pdo->prepare($sqlCasting);
            $castingStatement->execute();
        }else{
            echo 'casting deja fait';
        }
        
        require "view/ajouterCastingPage.php"; // redirige vers la page ajouterCastingPage
    }


    /* Methode ajouterRole($role)
        1. execute une requête SQL qui va recuperer tout les role dans la bdd

        2. Condition if qui verifie que la requête de l'etape 1 ne contient rien

        3. execute une requête SQL qui va ajouter le role
    */
    public function ajouterRole($role) {
        $pdo = Connect::seConnecter(); // On se connect a la base de données
        
        // \/ Etape 1
        $requeteCheckRole =  "
        SELECT nomPersonnage
        FROM role
        WHERE  nomPersonnage = '$role';";
        $CheckRoleStatement = $pdo->prepare($requeteCheckRole);
        $CheckRoleStatement->execute();
        $CheckRole =  $CheckRoleStatement->fetchAll();
        // \/ Etape 2
        if($CheckRole == NULL){
            // requete pour ajouter un role
            $sqlRole= "
            INSERT INTO `cinema`.`role` (`nomPersonnage`) 
            VALUES ('$role');";
            $roleStatement = $pdo->prepare($sqlRole);
            $roleStatement->execute();
        }else{
            return 'role deja ajouter';
        }
    }


    /* Methode ajouterFilm()
        1.1. execute une requête SQL qui va récupere les nom des genre en fonction du nom du genre qu'on va ajouter avec le film
        1.2. Condition if verife la requete précédent, si la valuer est null ajoute le genre a la bdd

        2.1. execute une requête SQL qui va récupere les nom des film en fonction du nom du film qu'on va ajouter avec le film
        2.2. Condition if verife la requete précédent, si la valuer est null ajoute le film a la bdd

        3. execute une requête SQL qui va ajouté à la bdd le film(titre,annee sortie,rea...)

        4. execute une requête SQL qui va ajouté à la bdd le genre du film
        */
    public function ajouterFilm() {

        $pdo = Connect::seConnecter();

        // filtre pour eviter d'injecter du code
        $titre = filter_var($_POST['titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $anneeSortie = filter_var($_POST['anneeSortie'], FILTER_SANITIZE_NUMBER_INT);
        $duree = filter_var($_POST['duree'], FILTER_SANITIZE_NUMBER_INT);
        $prenomReal = filter_var($_POST['prenomReal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nomReal = filter_var($_POST['nomReal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genre = filter_var($_POST['genre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $etoile = filter_var($_POST['etoile'], FILTER_SANITIZE_NUMBER_INT);
        $synopsis = filter_var($_POST['synopsis'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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
        }

        // \/ Etape 1.1
        $requeteCheckGenre = "
        SELECT genreLibelle
        FROM genre
        WHERE  genreLibelle = '$genre';";
        $CheckGenreStatement = $pdo->prepare($requeteCheckGenre);
        $CheckGenreStatement->execute();
        $checkGenre =  $CheckGenreStatement->fetchAll();

        // \/ Etape 1.2
        if($checkGenre == NULL){
            echo "yes genre";
            //requete pour ajouter un genre 
            $sqlGenre= "
            INSERT INTO `cinema`.`genre` (`genreLibelle`) 
            VALUES ('$genre');";
            $genreStatement = $pdo->prepare($sqlGenre);
            $genreStatement->execute();
        }

        // \/ Etape 2.1
        $requeteCheckFilm =  "
        SELECT titre
        FROM film
        WHERE  titre = '$titre';";
        $CheckFilmStatement = $pdo->prepare($requeteCheckFilm);
        $CheckFilmStatement->execute();
        $checkFILM =  $CheckFilmStatement->fetchAll();

        // \/ Etape 2.2
        if($checkFILM ==NULL){
            echo "yes film";
            // \/ Etape 3
            $sqlFilm= "
            INSERT INTO `cinema`.`film` (`titre`, `anneeSortieFrance`,`duree`,`etoile` ,`synopsis` , `affiche` ,`id_realisateur`) 
            SELECT '$titre', '$anneeSortie', '$duree','$etoile','$synopsis','',realisateur.id_realisateur
            FROM realisateur,personne
            WHERE realisateur.id_personne = personne.id_personne 
            AND personne.nom = '$nomReal'
            AND personne.prenom = '$prenomReal'";
            $filmStatement = $pdo->prepare($sqlFilm);
            $filmStatement->execute();

            // \/ Etape 4
            $sqlGenreFilm= "
            INSERT INTO `cinema`.`genrefilm` (`id_film`, `id_genre`)
            SELECT film.id_film,genre.id_genre
            FROM film,genre
            WHERE film.titre = '$titre'
            AND genre.genreLibelle ='$genre'";
            $genreFilmStatement = $pdo->prepare($sqlGenreFilm);
            $genreFilmStatement->execute();
        }

        require "view/ajouterFilmPage.php";// redirige vers la page ajouterCastingPage
    }

    /* Methode descModification($id)
        1. Condition if qui verifier que le titre est bien present
    */
    public function descModification($id) {
        $ctrlCinema = new CinemaController();
        $pdo = Connect::seConnecter();
        $titre = filter_var($_POST['titre'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $nomReal = filter_var($_POST['nomReal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $prenomReal = filter_var($_POST['prenomReal'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        if($titre != Null){
            $sqlUpdateTitre="
            UPDATE `cinema`.`film` 
            SET `titre`='$titre' 
            WHERE  `id_film`=$id;";
            $updateTitreStatement = $pdo->prepare($sqlUpdateTitre);
            $updateTitreStatement->execute();
        }

        if($nomReal != Null && $prenomReal != Null){
            $sqlUpdateTitre="
            UPDATE film
            SET id_realisateur =  (
                SELECT id_realisateur
                
                FROM realisateur,personne
                WHERE realisateur.id_personne = personne.id_personne
                
                AND nom='$nomReal'
                AND prenom='$prenomReal')
                
            WHERE  id_film=$id;";
            $updateTitreStatement = $pdo->prepare($sqlUpdateTitre);
            $updateTitreStatement->execute();
        }

        $ctrlCinema -> descModificationPage($id);
    }


    // FONCTION QUI SONT UTILISER PAR D'AUTRE FOCNTION [!]

    /* METHODE recuperGenreFilm($id)
        execute une requête SQL qui récuper le genre du film. la fonction a pour parametre $id.
        graçe à ça en pourra l'utiliser pour trouver le film dans la requête
    */
    public function recuperGenreFilm($id) {
        $pdo = Connect::seConnecter(); // se connecte  a la bdd

        $sqlGenre = "
        SELECT genreLibelle
        FROM film ,genre,genrefilm 
        WHERE film.id_film = genrefilm.id_film
        AND genrefilm.id_genre = genre.id_genre
        AND film.id_film = :id";
        $genreStatement = $pdo->prepare($sqlGenre);
        $genreStatement->execute(["id" => $id]);
        return $genreStatement->fetchAll();
    }
    
    /* METHODE recuperCastingFilm($id)
        execute une requête SQL qui récuper le casting du film. la fonction a pour parametre $id.
        graçe à ça en pourra l'utiliser pour trouver le film dans la requête
    */
    public function recuperCastingFilm($id) {
        $pdo = Connect::seConnecter();
        // requete pour recupere le genre
        $sqlCasting = "
        SELECT nom,prenom, nomPersonnage
        FROM film ,acteur,personne ,jouer, role
        WHERE film.id_film = jouer.id_film
        AND jouer.id_acteur = acteur.id_acteur
        AND acteur.id_personne = personne.id_personne
        AND role.id_role = jouer.id_role
        AND jouer.id_film = :id
        ORDER BY anneeSortieFrance DESC;";
        $castingStatement = $pdo->prepare($sqlCasting);
        $castingStatement->execute(["id" => $id]);
        return $castingStatement->fetchAll();
    }

    /* METHODE recuperDescFilm($id)
        execute une requête SQL qui récuper le genre du film. la fonction a pour parametre $id.
        graçe à ça en pourra l'utiliser pour trouver le film dans la requête
    */
    public function recuperDescFilm($id) {
        $pdo = Connect::seConnecter();
        // requete pour recupere le genre
        $sqlFilm = "
        SELECT titre,anneeSortieFrance,affiche,synopsis,nom,prenom
        FROM film ,realisateur,acteur ,personne 
        WHERE film.id_realisateur = realisateur.id_realisateur
        AND realisateur.id_personne = personne.id_personne
        AND film.id_film = :id
        GROUP BY film.id_film
        ORDER BY anneeSortieFrance DESC";
        $filmsStatement = $pdo->prepare($sqlFilm);
        $filmsStatement->execute(["id" => $id]);
        return $filmsStatement->fetchAll();
    }
}
