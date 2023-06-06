<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterCasting" method="POST" enctype="multipart/form-data">

    <!-- liste d'options des film dans la bdd-->
    <label for="film">Film:</label>
    <select name="film">
    <?php // boucle pour affiche les acteur un par un
        foreach($requeteFilm as $film){?>
        <option><?= $film["titre"]?></option>
    <?php }?>
    </select>
    <br><br>

    <!-- liste d'options des role dans la bdd-->
    <label for="role">Role:</label>
    <select name="role" id="role">
    <?php // boucle pour affiche les acteur un par un
        foreach($requeteRole as $role){?>
        <option><?= $role["nomPersonnage"]?></option>
    <?php }?>
    </select>
    <br><br>


    <!-- liste d'options des nom des acteur dans la bdd-->
    <label for="acteurNom">acteur Nom:</label>
    <select name="acteurNom" id="acteurNom">
    <?php // boucle pour affiche les acteur un par un
        foreach($requeteActeur as $acteur){?>
        <option><?= $acteur["nom"]?></option>
    <?php }?>
    </select>
    <br><br>

    <!-- liste d'options des prenom des acteur dans la bdd-->
    <label for="acteurPrenom">acteur Prenom:</label>
    <select name="acteurPrenom" id="acteurPrenom">
    <?php // boucle pour affiche les acteur un par un
        foreach($requeteActeur as $acteur){?>
        <option><?= $acteur["prenom"]?></option>
    <?php }?>
    </select>
    <br><br>
    <!-- input pour envoyé le formulaires -->
    <input type="submit" value="ajouter personne" >

</form>

<?php
$titre = "Ajouter personne";
$titreSecondaire = "Ajouter personne";
$contenu = ob_get_clean();
require "view/template.php";