<?php ob_start(); 


foreach($alphabet as $lettres){?>
    <div class="alphabetBar"><h3>Lettres <?= $lettres?></h3></div>
    
    <div class="personneContaineur">
        <?php foreach($requeteActeur as $acteur){
            if($acteur['nom'][0] == $lettres){?>
                    <a class="lienPersonne" href="index.php?action=filmographieAct&id=<?= $acteur['id_acteur']?>"><?= $acteur['nom']?> <?= $acteur['prenom']?><br></a><?php 
            } 
        }?>
    </div><?php
}?>


<?php
$titre = "Liste Acteur";
$titreSecondaire = "Liste Acteur";
$contenu = ob_get_clean();
require "template.php";
