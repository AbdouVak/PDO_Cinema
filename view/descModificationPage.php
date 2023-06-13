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
            // boucle 
            foreach($requeteReal as $nom){?>
                <option><?= $nom["nom"]?></option>
            <?php }?>
        </datalist><br><br>

        <label for="realPrenom">Réalisateur prenom:</label>
        <input type="text" name="prenomReal" list="realPrenomList" value='<?= $desc['prenom'] ?>' required minlength="3" maxlength="20" size="10">
        <datalist id="realPrenomList"><?php 
            // boucle 
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
            <form action="index.php?action=modifierCasting&id=<?=$idFilm?>" method="POST" id="modifier acteur">
            <label for="role">Role :</label>
            <input type="text" name="role" list="roleList" value='<?= $casting['nomPersonnage'] ?>' required minlength="3" maxlength="20" size="10">
            <datalist id="roleList"><?php 
                // boucle 
                foreach($requeteRole as $role){?>
                    <option> <?= $role["nomPersonnage"]?></option>
                <?php }?>
            </datalist>
            <br><br>

            <label for="acteurPrenom">Acteur prenom:</label>
            <input type="text" name="acteurPrenom" list="acteurPrenomList" value='<?= $casting['prenom'] ?>' required minlength="3" maxlength="20" size="10">
            <datalist id="acteurPrenomList"><?php 
                // boucle 
                foreach($requeteActeur as $acteur){?>
                    <option> <?= $acteur["prenom"]?></option>
                <?php }?>
            </datalist><br><br>

            <label for="acteurNom">Acteur nom:</label>
            <input type="text" name="acteurNom" list="acteurNomList" value='<?= $casting['nom'] ?>' required minlength="3" maxlength="20" size="10">
            <datalist id="acteurNomList"><?php 
                // boucle 
                foreach($requeteActeur as $acteur){?>
                    <option> <?= $acteur["nom"]?></option>
                <?php }?>
            </datalist><br><br><br>
            <input type="submit" value="modifier acteur" >
            </form><br><br>
        <?php }?>
        
        
        <h2>Année de sortie</h2>
        <!-- +-----------------------------------------+  -->
        <!-- |     titre :  [     ]                    |  -->
        <!-- +-----------------------------------------+  -->
        <form action="index.php?action=modifierAnnee&id=<?=$idFilm?>" method="POST" id="modifier année">
            Année Sortie : 
            <input type="text" name="anneeSortie" value='<?= $desc['anneeSortieFrance'] ?>' required minlength="3" maxlength="20" size="10"> <br></br>
            <input type="submit" value="modifier année" >
        </form><br></br>

        
        <h2>Genre</h2>
        <!-- +-----------------------------------------+  -->
        <!-- |     Genre :                             |  -->
        <!-- |     [     ]                             |  -->
        <!-- +-----------------------------------------+  -->
        <form action="index.php?action=modifierGenre&id=<?=$idFilm?>" method="POST" id="modifier genre">
            <?php foreach($requeteGenreFilm as $genreFilm){?><br>
                <input type="text" name="genre" list="genreList" value='<?= $genreFilm['genreLibelle']?>' required minlength="3" maxlength="20" size="10">
                <datalist id="genreList"><?php 
                    // boucle 
                    foreach($requeteGenre as $genre){?>
                        <option> <?= $genre["genreLibelle"]?></option>
                    <?php }?>
                </datalist><br><br>
            <?php }?>
            <input type="submit" value="modifier genre" >
        </form><br></br>


        <h2>Synopsis</h2>
        <!-- +-----------------------------------------+  -->
        <!-- |     Synopsis                            |  -->
        <!-- |     +--------------------+              |  -->
        <!-- |     |                    |              |  -->
        <!-- |     |                    |              |  -->
        <!-- |     +--------------------+              |  -->
        <!-- +-----------------------------------------+  -->
        <form action="index.php?action=modifierSynopsis&id=<?=$idFilm?>" method="POST" id="modifier synopsis">
        <label for="synopsis">Synopsis (optionnel) :</label><br>
        <textarea name="synopsis" cols="40" rows="5"></textarea>
        <br><br>
        <input type="submit" value="modifier synopsis" >
        </form>


        <h2>Poster</h2>
        <!-- +----------------------------------------+  -->
        <!-- |   Affiche :  [      ]                  |  -->
        <!-- +----------------------------------------+  -->
        <form action="index.php?action=modifierAffiche&id=<?=$idFilm?>" method="POST" id="modifier affiche" enctype="multipart/form-data">
        <label for="file">affiche :</label><br>
        <input type="file" name="file">
        <br><br>
        <input type="submit" value="modifier affiche" >
        </form>
    </div><?php }?>

</form> 
</div>


<?php

$titre = "Modifier description";
$titreSecondaire = "Modifier description";
$contenu = ob_get_clean();
require "template.php";