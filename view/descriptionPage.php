<?php ob_start();?>
<div class="descriptionContainer">
    <?php 
    foreach($requeteFilm as $desc){ ?>
            <div class="boxDescription"> 
                <div class="boxImage"><?php 
                    // affiche une img si le film n'a pas d'affiche
                    if($desc['affiche'] == NULL){?>
                        <img src="public/img/no-cover.png"><br><?php 
                    }else{// sinon on met l'affiche?>
                        <img src="public/img/<?= $desc['affiche']?>"><br><?php 
                    } 
                    ?>
                </div>

                <div class="boxText">
                    <div class="boxInfo">Titre : <?= $desc['titre'] ?></div></br>
                    <div class="boxInfo">Réalisateur : <br> -<a href="index.php?action=filmographieRea&id=<?=$desc['id_realisateur']?>"><?= $desc['nom'] .' '.$desc['prenom']  ?></a></div></br>
                        
                    <div class="boxInfo"> acteur : </br><?php 
                        // affiche les casting
                        foreach($requeteCasting as $casting){?>
                            - <a href="index.php?action=filmographieAct&id=<?=$casting['id_acteur']?>"><?= $casting['nom'] .' '.$casting['prenom'] ?></a><?=' role :'.$casting['nomPersonnage'] ?><br><?php 
                        }?>
                    </div><br>

                    <div class="boxInfo">Année Sortie France : <?= $desc['anneeSortieFrance'] ?></div></br>

                    <div class="boxInfo">Genre :<br><?php 
                        // affiche les genres
                        foreach($requeteGenre as $genre){?>
                            - <?= $genre['genreLibelle']?><br><?php 
                        }?>
                    </div>
                </div>
            </div>

        <?php 
        // affiche "Pas de synopsis" si il'y a pas de synopsis
            if($desc['synopsis'] == NULL){?>
                Synopsis :<br><p>Pas de synopsis</p><?php 
            }else{// sinon affiche le sinopsis?>
                Synopsis : <br><?= $desc['synopsis']?><?php 
            }?>
        <?php 
    }?><br>

        <a href="index.php?action=descModificationPage&id=<?= $idFilm ?>">Modifier</a>

</div>

<?php
$cssCustum = "<link rel='stylesheet' href='public/css/descriptionPage.css' />";
$titre = "Description Film";
$titreSecondaire = "Description Film";
$contenu = ob_get_clean();
require "template.php";