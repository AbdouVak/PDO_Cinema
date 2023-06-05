<?php ob_start();?>

<form action="index.php?action=ajouterPersonne" method="POST" enctype="multipart/form-data">

    <label for="nom">Nom:</label>
    <input type="text" name="nom" required minlength="3" maxlength="20" size="10">
    <br><br>

    <label for="name">Prenom:</label>
    <input type="text" name="prenom" required minlength="3" maxlength="20" size="10">
    <br><br>

    <label for="sexe">Sexe:</label>
    <select name="sexe" id="sexe">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
    </select>
    <br><br>

    <label for="dateNaissance">date naissance</label>
    <input type="date" name="dateNaissance">
    <br><br>
    
    <input type="submit" value="ajouter personne" >

</form>

<?php
$titre = "Ajouter personne";
$titreSecondaire = "Ajouter personne";
$contenu = ob_get_clean();
require "view/template.php";


// <form action="index.php?action=ajouterPersonne" method="POST"  >

