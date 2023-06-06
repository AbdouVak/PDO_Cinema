<?php ob_start();?>


<!-- formulaires -->
<form action="index.php?action=ajouterCasting" method="POST" enctype="multipart/form-data">
    <!-- +--------------------+ -->
    <!-- |   Film :  [   \/]  | -->
    <!-- +--------------------+ -->
    <label for="film">Film:</label>
    <select name="film"><?php 
        // boucle pour affiche les acteur un par un
        foreach($requeteFilm as $film){?>
            <option><?= $film["titre"]?></option><?php 
        }?>
    </select><br><br>

    <!-- +-------------------------------+  -->
    <!-- |   Role :  [              ]    | -->
    <!-- +-------------------------------+  -->
    <label for="role">Role:</label>
    <input type="text" name="role" required minlength="3" maxlength="20" size="10">
    <br><br>

    <!-- +----------------------------+  -->
    <!-- |   Acteur nom :  [   \/]    |  -->
    <!-- +----------------------------+  -->
    <label for="acteurNom">Acteur nom:</label>
    <select name="acteurNom" id="acteurNom"><?php 
        // boucle pour affiche les acteur un par un
        foreach($requeteActeur as $acteur){?>
            <option><?= $acteur["nom"]?></option><?php 
        }?>
    </select><br><br>

    <!-- +----------------------------+  -->
    <!-- |  Acteur prenom :  [   \/]  |  -->
    <!-- +----------------------------+  -->
    <label for="acteurPrenom">Acteur prenom:</label>
    <select name="acteurPrenom" id="acteurPrenom"><?php 
        // boucle pour affiche les acteur un par un
        foreach($requeteActeur as $acteur){?>
            <option><?= $acteur["prenom"]?></option><?php 
        }?>
    </select><br><br>
    <!-- +----------------------------+  -->
    <!-- |    [ ajouter personne ]    |-->
    <!-- +----------------------------+  -->
    <input type="submit" value="ajouter personne" >

</form>

<?php
$titre = "Ajouter Casting";
$titreSecondaire = "Ajouter role";
$contenu = ob_get_clean();
require "view/template.php";