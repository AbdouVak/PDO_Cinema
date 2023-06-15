<?php ob_start(); ?>
<main>

<div class="listegenre"><?php
    foreach($requeteGenre as $genre){?>
        <a href="#genre<?= $genre['genreLibelle'] ?>"><p><?= $genre['genreLibelle'] ?></p></a><?php
    }?>
</div><?php



foreach($requeteGenre as $genre){?>

    <div class="genreBar" id="genre<?=$genre['genreLibelle']?>"><h3><?= $genre['genreLibelle']?></h3></div>
    <div class='afficheConteneur'><?php
        foreach($requeteFilm as $Film){?> 
            <div class="afficheConteneur"><?php

                if($Film['genreLibelle'] == $genre['genreLibelle']){?>

                    <div class="affiche">
                        <p><?= $Film['titre']?>-<?= $Film['anneeSortieFrance']?></p><br>

                        <?php if($Film['affiche'] == NULL){
                            ?><a href='index.php?action=description&id=<?= $film['id_film'] ?>'><img src="public/img/no-cover.png" width='200'></a><br><?php 
                        }else{// sinon on met l'affiche
                            ?><a href='index.php?action=description&id=<?= $film['id_film'] ?>'><img src='public/img/<?= $Film['affiche']?>' width="200"></a><br><?php 
                        }?>
                    </div><?php  
                }?>
            </div><?php
        } ?>
    </div><?php
}?>
</main>
<?php
$cssCustum = "<link rel='stylesheet' href='public/css/listeGenrePage.css' />";
$titre = "Liste Genre";
$titreSecondaire = "Liste Genre";
$contenu = ob_get_clean();
require "template.php";