<?php ob_start();?>

<p> Il y a <?= $requete->rowCount()?> films</p>


<div><?php
    // boucle pour recupere les info du film. Chaque boucle est un film different
    foreach($requete->fetchAll() as $film){ 
        ?>
        <div>
            <p><?= $film["titre"] ?>-<?= $film["anneeSortieFrance"]?> </p>
            <!-- quand no va appuyer sur l'image redirige vers l'index avec l'action description et id_film du film de la boucle-->
            <?= "<a href='index.php?action=description&id= ".$film['id_film']." '><img src='public/img/test_img.jpg' width='200'></a>"?>
        </div>
<?php } ?></div>

<?php
$titre = "Acceuil";
$titreSecondaire = "Acceuil";
$contenu = ob_get_clean();
require "view/template.php";