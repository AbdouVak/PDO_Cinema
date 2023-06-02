<?php ob_start();?>

<p> Il y a <?= $requete->rowCount()?> films</p>


<div><?php
    foreach($requete->fetchAll() as $film){ 
        ?>
        <div>
            <p><?= $film["titre"] ?>-<?= $film["anneeSortieFrance"]?> </p>
            <a href="index.php?action=description&id= ".<?=$film["id_film"]?>.""><img src="public/img/test_img.jpg" width="200"></a>
        </div>
<?php } ?></div>

<?php
$titre = "Liste des films";
$titreSecondaire = "Liste des films";
$contenu = ob_get_clean();
require "view/template.php";