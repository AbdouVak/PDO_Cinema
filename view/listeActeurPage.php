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
        <?php foreach($requeteActeur as $acteur){
            if($acteur['nom'][0] == $lettres){?>
                    <a class="lienPersonne" href="index.php?action=filmographieAct&id=<?= $acteur['id_acteur']?>"><?= $acteur['nom']?> <?= $acteur['prenom']?><br></a><?php 
            } 
        }?>
    </div><?php
}?>
</main>

<?php
$cssCustum = "<link rel='stylesheet' href='public/css/listerPage.css' />";
$titre = "Liste Acteur";
$titreSecondaire = "Liste Acteur";
$contenu = ob_get_clean();
require "template.php";
