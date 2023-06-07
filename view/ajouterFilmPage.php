<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterFilm" method="POST" enctype="multipart/form-data">
    
    <!-- +----------------------------------------+  -->
    <!-- |   Titre :  [              ]            |  -->
    <!-- +----------------------------------------+  -->
    <label for="titre">Titre:</label>
    <input type="text" name="titre" required minlength="3" maxlength="20" size="10"><br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Prénom Réalisateur :  [        \/ ]  |  -->
    <!-- +----------------------------------------+  -->
    <label for="prenomReal">Prénom réalisateur:</label>
    <input type="text" name="prenomReal" list="prenomList" required minlength="3" maxlength="20" size="10">
    <datalist id="prenomList"><?php 
        // boucle pour affiche les genre un par un
        foreach($requeteReal as $real){?>
            <option><?= $real["nom"]?></option>
    	    <?php 
        }?>
    </datalist><br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Nom Réalisateur :  [        \/ ]     |  -->
    <!-- +----------------------------------------+  -->
    <label for="nomReal">Nom réalisateur:</label>
    <input type="text" name="nomReal" list="nomList" required minlength="3" maxlength="20" size="10">
    <datalist id="nomList"><?php 
        // boucle pour affiche les genre un par un
        foreach($requeteReal as $real){?>
            <option><?= $real["prenom"]?></option>
    	    <?php 
        }?>
    </datalist><br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Genre :  [        \/ ]               |  -->
    <!-- +----------------------------------------+  -->
    <label for="genre">Genre:</label>
    <input type="text" name="genre" list="genreList" required minlength="3" maxlength="20" size="10">
    <datalist id="genreList"><?php 
        // boucle pour affiche les genre un par un
        foreach($requeteGenre as $genre){?>
            <option><?= $genre["genreLibelle"]?></option>
    	    <?php 
        }?>
    </datalist><br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Année Sortie :  [      ]             |  -->
    <!-- +----------------------------------------+  -->
    <label for="anneeSortie">Année Sortie:</label>
    <input type="text" name="anneeSortie" required minlength="4" maxlength="4" size="4">
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Durée :  [      ]                    |  -->
    <!-- +----------------------------------------+  -->
    <label for="duree">Durée:</label>
    <input type="text" name="duree" required minlength="3" maxlength="4" size="4">
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Etoile :  [      ]                   |  -->
    <!-- +----------------------------------------+  -->
    <label for="etoile">étoile (optionnel) :</label>
    <input type="etoile" name="etoile" required minlength="1" maxlength="1" size="1">
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Synopsis :  [      ]                 |  -->
    <!-- +----------------------------------------+  -->
    <label for="synopsis">Synopsis (optionnel) :</label><br>
    <textarea name="synopsis" cols="40" rows="5"></textarea>
    <br><br>

    <label for="file"> Affiche film :</label> 
    <input type="file" name="file" >
    <br><br>
    
    <!-- +----------------------------------------+  -->
    <!-- |  [ ajouter film ]                      |  -->
    <!-- +----------------------------------------+  -->
    <input type="submit" value="ajouter film" >

</form>

<?php
$titre = "Ajouter film";
$titreSecondaire = "Ajouter film";
$contenu = ob_get_clean();
require "view/template.php";

/*
    <label for="etoile">étoile (optionnel) :</label>
    <input type="text" name="etoile" required minlength="1" maxlength="1" size="1">
    <br><br>

    <!-- laffiche -->
    <label for="affiche">Affiche (optionnel) :</label>
    <input type="text" name="affiche" required minlength="3" maxlength="20" size="10">
    <br><br>

    <!-- synopsis -->
    <label for="synopsis">Synopsis (optionnel) :</label><br>
    <textarea name="Text1" cols="40" rows="5"></textarea>
    <br><br>
*/