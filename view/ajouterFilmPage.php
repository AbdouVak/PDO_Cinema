<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterFilm" method="POST" enctype="multipart/form-data">
    <!-- +-------------------------------------+  -->
    <!-- |   Titre :  [              ]         |  -->
    <!-- +-------------------------------------+  -->
    <label for="titre">Titre:</label>
    <input type="text" name="titre" required minlength="3" maxlength="20" size="10"><br><br>

    <!-- +-------------------------------------+  -->
    <!-- |   Réalisateur nom :  [  \/ ]        |  -->
    <!-- +-------------------------------------+  -->
    <label for="realisateurNom">Réalisateur nom:</label>
    <select name="realisateurNom" ><?php 
        // boucle pour affiche les realisateur un par un
        foreach($requeteReal as $real){
            ?><option><?= $real["nom"]?></option><?php 
        }?>
    </select><br><br>

    <!-- +-------------------------------------+  -->
    <!-- |   Réalisateur prenom :  [  \/ ]     |  -->
    <!-- +-------------------------------------+  -->
    <label for="realisateurPrenom">Réalisateur prenom:</label>
    <select name="realisateurPrenom"><?php 
        // boucle pour affiche les realisateur un par un
        foreach($requeteReal as $real){
            ?><option><?= $real["prenom"]?></option><?php 
        }?>
    </select><br><br>
    
    <!-- +-------------------------------------+  -->
    <!-- |   Genre :  [  \/ ] ou [    ]        |  -->
    <!-- +-------------------------------------+  -->
    <label for="genre">Genre:</label>
    <select name="genre"><?php 
        // boucle pour affiche les genre un par un
        foreach($requeteGenre as $genre){?>
            <option><?= $genre["genreLibelle"]?></option>
    	    <?php 
        }?>
        <input type="text" name="genre" required minlength="4" maxlength="20" size="10">
    </select><br><br>

    <!-- +-------------------------------------+  -->
    <!-- |   Année Sortie :  [      ]          |  -->
    <!-- +-------------------------------------+  -->
    <label for="anneeSortie">Année Sortie:</label>
    <input type="text" name="anneeSortie" required minlength="4" maxlength="4" size="4">
    <br><br>

    <!-- +-------------------------------------+  -->
    <!-- |   Durée :  [      ]                 |  -->
    <!-- +-------------------------------------+  -->
    <label for="duree">Durée:</label>
    <input type="text" name="duree" required minlength="3" maxlength="4" size="4">
    <br><br>

    <!-- +-------------------------------------+  -->
    <!-- |  [ ajouter personne ]               |  -->
    <!-- +-------------------------------------+  -->
    <input type="submit" value="ajouter personne" >

</form>

<?php
$titre = "Ajouter film";
$titreSecondaire = "Ajouter film";
$contenu = ob_get_clean();
require "view/template.php";