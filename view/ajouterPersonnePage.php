<?php ob_start();?>

<main><!-- formulaires -->

<form action="index.php?action=ajouterPersonne"  method="POST" enctype="multipart/form-data" >

    <!-- champ de texte pour le nom de la personne-->
    <div class="inputConteneurs">
        <label for="nom">Nom</label>
        <input type="text" name="nom" required minlength="3" maxlength="20" size="5">
    </div>

    <!-- champ de texte pour le prenom de la personne-->
    <div class="inputConteneurs">
        <label for="name">Prenom</label>
        <input type="text" name="prenom" required minlength="3" maxlength="20" size="10">
    </div>
    <!-- lis
    te d'options si home ou femme -->
    <div class="inputConteneurs">
        <label for="sexe">Sexe</label>
        <select name="sexe" id="sexe">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select>
    </div>

    <!-- champ de texte pour la date de naissance-->
    <div class="inputConteneurs">
        <label for="dateNaissance">date naissance</label>
        <input type="date" name="dateNaissance">
    </div>

    <!-- liste d'options si homme ou femme -->
    <div class="inputConteneurs">
        <label for="metier">Métier</label>
        <select name="metier" >
            <option value="acteur">Acteur</option>
            <option value="realisateur">Réalisateur</option>
        </select>
    </div>

    <!-- input pour envoyé le formulaires -->
    <div class="inputConteneurs">
        <input type="submit" value="ajouter personne" >
    </div>

</form>

</main>

<?php
$cssCustum = "<link rel='stylesheet' href='public/css/ajouterPersonnePage.css' />";
$titre = "Ajouter personne";
$titreSecondaire = "Ajouter personne";
$contenu = ob_get_clean();
require "template.php";


