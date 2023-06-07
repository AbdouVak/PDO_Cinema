<?php ob_start();?>

<p> Il y a <?= $requete->rowCount()?> films</p>

<div><?php
    // boucle pour recupere les info du film. Chaque boucle est un film different
    foreach($requete->fetchAll() as $film){
        ?>
        <div>
            <p><?= $film["titre"] ?>-<?= $film["anneeSortieFrance"]?> </p>
            <!-- quand no va appuyer sur l'image redirige vers l'index avec l'action description et id_film du film de la boucle-->
            
            <?php // affiche une img si le film n'a pas d'affiche
            if($film['affiche'] == NULL){
                ?><a href='index.php?action=description&id=<?= $film['id_film'] ?>'> <img src="public/img/no-cover.png" width='200'></a><br><?php 
            }else{// sinon on met l'affiche
                ?><a href='index.php?action=description&id=<?= $film['id_film'] ?>'> <img src='public/img/<?= $film['affiche']?>' width="200"></a><br><?php 
            } ?>
            </div>
<?php } ?></div>

<?php
$titre = "Acceuil";
$titreSecondaire = "Acceuil";
$contenu = ob_get_clean();
require "view/template.php";