<?php ob_start();?>
<!-- formulaires -->
<form action="index.php?action=ajouterFilm" method="POST">
    
    <!-- +----------------------------------------+  -->
    <!-- |   Titre :  [              ]            |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="titre">Titre:</label>
        <input type="text" name="titre" required minlength="3" maxlength="20" size="10">
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Nom Réalisateur :  [        \/ ]     |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="nomReal">Nom réalisateur:</label>
        <input type="text" name="nomReal" list="nomList" required minlength="3" maxlength="20" size="10">
        <datalist id="nomList"><?php 
            foreach($requeteRealNom as $realNom){?>
                <option><?= $realNom["nom"]?></option>
                <?php 
            }?>
        </datalist>
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Prénom Réalisateur :  [        \/ ]  |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="prenomReal">Prénom réalisateur:</label>
        <input type="text" name="prenomReal" list="prenomList" required minlength="3" maxlength="20" size="10">
        <datalist id="prenomList"><?php 
            foreach($requeteRealPrenom as $realPrenom){?>
                <option><?= $realPrenom["prenom"]?></option>
                <?php 
            }?>
        </datalist>
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Genre :  ....[X] ....[ ] ....[ ]     |  -->
    <!-- |            ....[ ] ....[X] ....[ ]     |  -->
    <!-- |   Ajouter Genre : [        ]           |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="genre">Genre:</label><br><?php 
        foreach($requeteGenre as $genre){?>
            <label for="genre"><?= $genre["genreLibelle"]?></label>
            <input type="checkbox" name="genre[]" value="<?= $genre["genreLibelle"]?>">
            <?php 
        }?>
        <label for="ajouterGenre">Ajouter genre (genre1, genre2, ...):</label>
        <input type="text" name="ajouterGenre" minlength="3" maxlength="20" size="10">
    </div>
    <!-- +----------------------------------------+  -->
    <!-- |   Année Sortie :  [      ]             |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="anneeSortie">Année Sortie:</label>
        <input type="text" name="anneeSortie" required minlength="4" maxlength="4" size="4">
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Durée :  [      ]                    |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="duree">Durée:</label>
        <input type="text" name="duree" required minlength="3" maxlength="4" size="4">
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Etoile :  [      ]                   |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="etoile">étoile (option) :</label>
        <input type="etoile" name="etoile" minlength="1" maxlength="1" size="1">
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Synopsis :  [      ]                 |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="synopsis">Synopsis (option) :</label>
        <textarea name="synopsis" cols="40" rows="5"></textarea>
    </div>

    <!-- +----------------------------------------+  -->
    <!-- |   Affiche :  [      ]                  |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs">
        <label for="file"> Affiche film :</label> 
        <input type="file" name="file" >
    </div>
    
    <!-- +----------------------------------------+  -->
    <!-- |  [ ajouter film ]                      |  -->
    <!-- +----------------------------------------+  -->
    <div class="inputConteneurs center">
        <input type="submit" value="ajouter film" >
    </div>
</form>
<?php
$cssCustum = "<link rel='stylesheet' href='public/css/ajouterFilmPage.css' />";
$titre = "Ajouter film";
$titreSecondaire = "Ajouter film";
$contenu = ob_get_clean();
require "template.php";