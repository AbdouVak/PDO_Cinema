<?php ob_start(); 


foreach($alphabet as $lettres){?>
    <div class="alphabetBar"><h3>Lettres <?= $lettres?><br></div>

    <div class="personneContaineur">
        <?php foreach($requeteRea as $realisateur){
            if($realisateur['nom'][0] == $lettres){?>
                    <a class="lienPersonne" href="index.php?action=filmographieRea&id=<?= $realisateur['id_realisateur']?>"><?= $realisateur['nom']?> <?= $realisateur['prenom']?><br></a><?php 
            } 
        }?>
    </div><?php
}?>


<?php
$titre = "Liste Realisateur";
$titreSecondaire = "Liste Realisateur";
$contenu = ob_get_clean();
require "template.php";