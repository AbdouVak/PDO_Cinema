<?php ob_start(); ?>
<main>

<div class="listeAlphabet"><?php
    foreach($alphabet as $lettres){?>
        <a href="#lettre<?= $lettres ?>"><p><?= $lettres ?></p></a><?php
    }?>
</div><?php

foreach($alphabet as $lettres){?>
    <div class="alphabetBar"><h3>Lettres <?= $lettres?></h3></div>
    
    <div class="personneContaineur" id="lettre<?= $lettres ?>">
        <?php foreach($requeteRea as $realisateur){
            if($realisateur['nom'][0] == $lettres){?>
                    <a class="lienPersonne" href="index.php?action=filmographieRea&id=<?= $realisateur['id_realisateur']?>"><?= $realisateur['nom']?> <?= $realisateur['prenom']?><br></a><?php 
            } 
        }?>
    </div><?php
}?>
</main>


<?php
$cssCustum = "<link rel='stylesheet' href='public/css/listerPage.css' />";
$titre = "Liste Realisateur";
$titreSecondaire = "Liste Realisateur";
$contenu = ob_get_clean();
require "template.php";