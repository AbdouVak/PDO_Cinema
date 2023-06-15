<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterCasting" method="POST" enctype="multipart/form-data">
    
    <!-- +-----------------------------------+ -->
    <!-- |    Film :  [   \/]                | -->
    <!-- +-----------------------------------+ -->
    <div class="inputConteneurs">
        <label for="film">Film:</label>
        <input type="text" name="film" list="filmList" required minlength="3" maxlength="20" size="10">
        <datalist id="filmList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteFilm as $film){?>
                <option><?= $film["titre"]?></option><?php 
            }?>
        </datalist>
    </div>

    <!-- +-----------------------------------+  -->
    <!-- |    Role : [   \/ ] [          ]   | -->
    <!-- +-----------------------------------+  -->
    <div class="inputConteneurs">
        <label for="role">Role:</label>
        <input type="text" name="role" list="roleList" required minlength="3" maxlength="20" size="10">
        <datalist id="roleList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteRole as $role){?>
                <option><?= $role["nomPersonnage"]?></option><?php 
            }?>
        </datalist>
    </div>

    <!-- +-----------------------------------+  -->
    <!-- |    Acteur nom :  [   \/]          |  -->
    <!-- +-----------------------------------+  -->
    <div class="inputConteneurs">
        <label for="acteurNom">Acteur nom:</label>
        <input type="text" name="acteurNom" list="acteurNomList" required minlength="3" maxlength="20" size="10">
        <datalist id="acteurNomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteActeurNom as $acteur){?>
                <option><?= $acteur["nom"]?></option>
            <?php }?>
        </datalist>
    </div>
    <!-- +-----------------------------------+  -->
    <!-- |    Acteur prenom :  [   \/]       |  -->
    <!-- +-----------------------------------+  -->
    <div class="inputConteneurs">
        <label for="acteurPrenom">Acteur prenom:</label>
        <input type="text" name="acteurPrenom" list="acteurPrenomList" required minlength="3" maxlength="20" size="10">
        <datalist id="acteurPrenomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteActeurPrenom as $acteur){?>
                <option> <?= $acteur["prenom"]?> </option>
            <?php }?>
        </datalist>
    </div>
    
    <!-- +-----------------------------------+  -->
    <!-- |    [ ajouter personne ]           |  -->
    <!-- +-----------------------------------+  -->
    <div class="inputConteneurs center" >
        <input type="submit" value="ajouter personne" >
    </div>

</form>
<?php
$cssCustum = "<link rel='stylesheet' href='public/css/ajouterCastingPage.css' />";
$titre = "Ajouter Casting";
$titreSecondaire = "Ajouter role";
$contenu = ob_get_clean();
require "template.php";