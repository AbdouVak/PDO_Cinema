<?php ob_start();?>
<main>
<p> description du film</p>

<a href="index.php?action=descModificationPage&id=<?= $idFilm ?>">Modifier</a>

<div>
<?php 
foreach($requeteFilm as $desc){ ?>
    <div>
        <?php // affiche une img si le film n'a pas d'affiche
        if($desc['affiche'] == NULL){
            ?><img src="public/img/no-cover.png"><br><?php 
        }else{// sinon on met l'affiche
            ?><img src="public/img/<?= $desc['affiche']?>"><br><?php 
        } ?>

        titre : <?= $desc['titre'] ?></br>
        Réalisateur : <br> -<a href="index.php?action=filmographieRea&id=<?=$desc['id_realisateur']?>"><?= $desc['nom'] .' '.$desc['prenom']  ?></a></br>
        
        acteur : </br>
        <?php // affiche les acteur
            foreach($requeteCasting as $casting){?>
                - <a href="index.php?action=filmographieAct&id=<?=$casting['id_acteur']?>"><?= $casting['nom'] .' '.$casting['prenom'] ?></a><?=' role :'.$casting['nomPersonnage'] ?><br>
            <?php }
        ?>

        Année Sortie France : <?= $desc['anneeSortieFrance'] ?></br>

        Genre :<br>
        <?php // affiche les acteur
            foreach($requeteGenre as $genre){?>

                - <?= $genre['genreLibelle']?><br>

            <?php }
        ?>

        <?php // affiche "Pas de synopsis" si il'y a pas de synopsis
        if($desc['synopsis'] == NULL){
            ?>Synopsis :<br><p>Pas de synopsis</p><?php 
        }else{// sinon affiche le sinopsis
            ?>Synopsis : <br><?= $desc['synopsis']?><?php 
        } ?>
    </div>
<?php }?>

</main>

</div>


<?php
$titre = "Acceuil";
$titreSecondaire = "Acceuil";
$contenu = ob_get_clean();
require "template.php";