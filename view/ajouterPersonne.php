<?php ob_start();?>

<form action="/action_page.php">

<label for="nom">Nom:</label>
<input type="text" id="nom" name="nom" required minlength="4" maxlength="20" size="10">

<br><br>
<label for="name">Prenom:</label>
<input type="text" id="nom" name="nom" required minlength="3" maxlength="20" size="10">

<br><br>

<label for="sexe">Sexe:</label>
<select name="sexe" id="sexe">
    <option value="Homme">Homme</option>
    <option value="Femme">Femme</option>
</select>
<br><br>

<label for="dateNaissance">date naissance</label>

<input type="date" id="dateNaissance" name="dateNaissance">

<br><br>
<input type="submit" value="Submit">

</form>
<?php
$titre = "Ajouter personne";
$titreSecondaire = "Ajouter personne";
$contenu = ob_get_clean();
require "view/template.php";