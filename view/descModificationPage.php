<?php ob_start();?>

<?php 
foreach($requeteFilm as $desc){ ?>
    <div>
        <h2>Titre</h2>
        <!-- +-----------------------------------------+  -->
        <!-- |     titre :  [     ]                    |  -->
        <!-- +-----------------------------------------+  -->
        <form action="index.php?action=modifierTitre&id=<?=$idFilm?>" method="POST" id="modifier titre">
            Titre : 
            <input type="text" name="titre" value='<?= $desc['titre'] ?>' required minlength="3" maxlength="20" size="10">
            <input type="submit" value="modifier titre" >
        </form><br></br>





        <h2>Realisateur</h2>
        <!-- +-----------------------------------------+  -->
        <!-- |     Nom Réalisateur :  [   \/]          |  -->
        <!-- |     Prenom Réalisateur :  [   \/]       |  -->
        <!-- +-----------------------------------------+  -->
        <form action="index.php?action=modifierRealisateur&id=<?=$idFilm?>" method="POST" id="modifier réalisateur">
            
        <label for="realNom">Réalisateur nom:</label>
        <input type="text" name="nomReal" list="realNomList" value='<?= $desc['nom'] ?>' required minlength="3" maxlength="20" size="10">
        <datalist id="realNomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteReal as $nom){?>
                <option><?= $nom["nom"]?></option>
            <?php }?>
        </datalist><br><br>

        <label for="realPrenom">Réalisateur prenom:</label>
        <input type="text" name="prenomReal" list="realPrenomList" value='<?= $desc['prenom'] ?>' required minlength="3" maxlength="20" size="10">
        <datalist id="realPrenomList"><?php 
            // boucle pour affiche les acteur un par un
            foreach($requeteReal as $acteur){?>
                <option> <?= $acteur["prenom"]?> </option>
            <?php }?>
        </datalist><br></br>

        <input type="submit" value="modifier réalisateur" >
        </form><br><br>





        <h2>Casting</h2>
        <!-- +-----------------------------------------+  -->
        <!-- |     Casting :                           |  -->
        <!-- |     Role:  [   \/]                      |  -->
        <!-- |     Nom Acteur:  [   \/]                |  -->
        <!-- |     Prénom Acteur:  [   \/]             |  -->
        <!-- +-----------------------------------------+  -->
        

        <?php foreach($requeteCasting as $casting){?>
            <form action="index.php?action=modifierActeur&id=<?=$idFilm?>" method="POST" id="modifier acteur">
            <label for="role">Role :</label>
            <input type="text" name="role" value='<?= $casting['nomPersonnage'] ?>' required minlength="3" maxlength="20" size="10">
            <br><br>

            <label for="acteurPrenom">Acteur prenom:</label>
            <input type="text" name="acteurPrenom" list="acteurPrenomList" value='<?= $casting['prenom'] ?>' required minlength="3" maxlength="20" size="10">
            <datalist id="acteurPrenomList"><?php 
                // boucle pour affiche les acteur un par un
                foreach($requeteActeur as $acteur){?>
                    <option> <?= $acteur["prenom"]?></option>
                <?php }?>
            </datalist><br><br>

            <label for="acteurNom">Acteur nom:</label>
            <input type="text" name="acteurNom" list="acteurNomList" value='<?= $casting['nom'] ?>' required minlength="3" maxlength="20" size="10">
            <datalist id="acteurNomList"><?php 
                // boucle pour affiche les acteur un par un
                foreach($requeteActeur as $acteur){?>
                    <option> <?= $acteur["nom"]?></option>
                <?php }?>
            </datalist><br><br><br>
            <input type="submit" value="modifier acteur" >
            </form><br><br>
        <?php }?>
        
        






    </div><?php }?>

</form> 
</div>


<?php

$titre = "Modifier description";
$titreSecondaire = "Modifier description";
$contenu = ob_get_clean();
require "template.php";