<?php ob_start();?>
<?php // affiche les acteur

        foreach($requeteFilm as $Film){?>
            Titre : <?= $Film[0] ?>-<?= $Film[1] ?><br>
            <?php if (isset($Film['nomPersonnage']) ){?>
                Role : <?= $Film['nomPersonnage'] ?><br></br><?php
            }
            if($Film['affiche'] == NULL){
                ?><img src="public/img/no-cover.png" width='200'><br><?php 
            }else{// sinon on met l'affiche
                ?><img src='public/img/<?= $Film['affiche']?>' width="200"><br><?php 
            }?>
            
        <?php }?>
        </div>    
<?php 

$titre = "Filmograhie";
$titreSecondaire = "Filmograhie";
$contenu = ob_get_clean();
require "template.php";