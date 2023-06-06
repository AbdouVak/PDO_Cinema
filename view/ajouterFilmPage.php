<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterFilm" method="POST" enctype="multipart/form-data">
    <!-- +------------------------------+  -->
    <!-- |   Titre :  [              ]  |  -->
    <!-- +------------------------------+  -->
    <label for="titre">Titre:</label>
    <input type="text" name="titre" required minlength="3" maxlength="20" size="10"><br><br>

    <!-- +------------------------------+  -->
    <!-- |   Réalisateur :  [  \/ ]     |  -->
    <!-- +------------------------------+  -->
    <label for="realisateur">Réalisateur:</label>
    <select name="realisateur" id="realisateur"><?php 
        // boucle pour affiche les acteur un par un
        foreach($requeteReal as $real){
            ?><option><?= $real["nom"]?> <?= $real["prenom"]?></option><?php 
        }?>
    </select><br><br>
    
    <!-- +------------------------------+  -->
    <!-- |   Année Sorite :  [      ]   |  -->
    <!-- +------------------------------+  -->
    <label for="anneeSortie">Année Sortie:</label>
    <input type="text" name="anneeSortie" required minlength="4" maxlength="4" size="4">
    <br><br>

    <!-- +------------------------------+  -->
    <!-- |   Durée :  [      ]          |  -->
    <!-- +------------------------------+  -->
    <label for="duree">Durée:</label>
    <input type="text" name="duree" required minlength="3" maxlength="4" size="4">
    <br><br>

    <!-- +------------------------------+  -->
    <!-- |  [ ajouter personne ]        |  -->
    <!-- +------------------------------+  -->
    <input type="submit" value="ajouter personne" >

</form>

<?php
$titre = "Ajouter film";
$titreSecondaire = "Ajouter film";
$contenu = ob_get_clean();
require "view/template.php";