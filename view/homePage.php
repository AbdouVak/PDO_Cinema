<?php ob_start();?>

<p> Site regroupant plusieur film</p></br>
<p> Permet de trier les film en fonction du genre / realisateur / acteur / date de srotie / </p>
<?php
$titre = "Acceuil";
$titreSecondaire = "Acceuil";
$contenu = ob_get_clean();
require "view/template.php";