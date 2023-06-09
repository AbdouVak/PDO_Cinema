<?php ob_start();?>
<div>
<form action="index.php?action=descModification&id=<?=$idFilm?>" method="POST" enctype="multipart/form-data">
<?php 
foreach($requeteFilm as $desc){ ?>
    <div>
        Titre : <input type="text" name="titre" placeholder='<?= $desc['titre'] ?>' required minlength="3" maxlength="20" size="10"> <br></br>
        

        <!-- +-----------------------------------+  -->
        <!-- |    Acteur nom :  [   \/]          |  -->
        <!-- +-----------------------------------+  -->
        <label for="realNom">Réalisateur nom:</label>
        <input type="text" name="nomReal" list="realNomList" required minlength="3" maxlength="20" size="10">
        <datalist id="realNomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteReal as $nom){?>
                <option><?= $nom["nom"]?></option>
            <?php }?>
        </datalist>(<?= $desc['nom'] ?>)<br><br>

        <!-- +-----------------------------------+  -->
        <!-- |    Acteur prenom :  [   \/]       |  -->
        <!-- +-----------------------------------+  -->
        <label for="realPrenom">Réalisateur prenom:</label>
        <input type="text" name="prenomReal" list="realPrenomList" required minlength="3" maxlength="20" size="10">
        <datalist id="realPrenomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteReal as $acteur){?>
                <option> <?= $acteur["prenom"]?> </option>
            <?php }?>
        </datalist>(<?= $desc['prenom'] ?>)<br><br>

        <!-- +-----------------------------------+  -->
        <!-- |    Acteur prenom :  [   \/]       |  -->
        <!-- +-----------------------------------+  -->
        <label for="acteurPrenom">Acteur prenom:</label>
        <input type="text" name="acteurPrenom" list="acteurPrenomList" required minlength="3" maxlength="20" size="10">
        <datalist id="acteurPrenomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteCasting as $casting){?>
                <option> <?= $casting["prenom"]?> </option>
            <?php }?>
        </datalist>(<?= $desc['prenom'] ?>)<br><br>

        <input type="submit" value="modifier film" >


    </div><?php }?>

</form> 
</div>


<?php

$titre = "Modifier description";
$titreSecondaire = "Modifier description";
$contenu = ob_get_clean();
require "template.php";