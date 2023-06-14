<?php ob_start(); ?>
<?php
foreach($requeteGenre as $genre){?>

    <div class="alphabetBar"><h3><?= $genre['genreLibelle']?></h3></div>
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

<?php
$titre = "Liste Genre";
$titreSecondaire = "Liste Genre";
$contenu = ob_get_clean();
require "template.php";