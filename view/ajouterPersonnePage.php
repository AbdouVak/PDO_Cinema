<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterPersonne" method="POST" enctype="multipart/form-data">

    <!-- champ de texte pour le nom de la personne-->
    <label for="nom">Nom:</label>
    <input type="text" name="nom" required minlength="3" maxlength="20" size="10">
    <br><br>

    <!-- champ de texte pour le prenom de la personne-->
    <label for="name">Prenom:</label>
    <input type="text" name="prenom" required minlength="3" maxlength="20" size="10">
    <br><br>

    <!-- liste d'options si home ou femme -->
    <label for="sexe">Sexe:</label>
    <select name="sexe" id="sexe">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>
    <br><br>

    <!-- champ de texte pour la date de naissance-->
    <label for="dateNaissance">date naissance</label>
    <input type="date" name="dateNaissance">
    <br><br>

    <!-- liste d'options si home ou femme -->
    <label for="metier">Métier:</label>
    <select name="metier" >
        <option value="acteur">Acteur</option>
        <option value="realisateur">Réalisateur</option>
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


