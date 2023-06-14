<?php ob_start();?>

<!-- formulaires -->
<form action="index.php?action=ajouterFilm" method="POST">
    
    <!-- +----------------------------------------+  -->
    <!-- |   Titre :  [              ]            |  -->
    <!-- +----------------------------------------+  -->
    <label for="titre">Titre:</label>
    <input type="text" name="titre" required minlength="3" maxlength="20" size="10"><br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Nom Réalisateur :  [        \/ ]     |  -->
    <!-- +----------------------------------------+  -->
    <label for="nomReal">Nom réalisateur:</label>
    <input type="text" name="nomReal" list="nomList" required minlength="3" maxlength="20" size="10">
    <datalist id="nomList"><?php 
        foreach($requeteRealNom as $realNom){?>
            <option><?= $realNom["nom"]?></option>
    	    <?php 
        }?>
    </datalist><br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Prénom Réalisateur :  [        \/ ]  |  -->
    <!-- +----------------------------------------+  -->
    <label for="prenomReal">Prénom réalisateur:</label>
    <input type="text" name="prenomReal" list="prenomList" required minlength="3" maxlength="20" size="10">
    <datalist id="prenomList"><?php 
        foreach($requeteRealPrenom as $realPrenom){?>
            <option><?= $realPrenom["prenom"]?></option>
    	    <?php 
        }?>
    </datalist><br><br>


    <!-- +----------------------------------------+  -->
    <!-- |   Genre :  ....[X] ....[ ] ....[ ]     |  -->
    <!-- |            ....[ ] ....[X] ....[ ]     |  -->
    <!-- |   Ajouter Genre : [        ]           |  -->
    <!-- +----------------------------------------+  -->
    <label for="genre">Genre:</label><?php 
    foreach($requeteGenre as $genre){?>
        <label for="genre"><?= $genre["genreLibelle"]?></label>
        <input type="checkbox" name="genre[]" value="<?= $genre["genreLibelle"]?>">
        <?php 
    }?><br></br>
    <label for="ajouterGenre">Ajouter genre (genre1, genre2, ...):</label>
    <input type="text" name="ajouterGenre" minlength="3" maxlength="20" size="10"><br><br>
    <!-- +----------------------------------------+  -->
    <!-- |   Année Sortie :  [      ]             |  -->
    <!-- +----------------------------------------+  -->
    <label for="anneeSortie">Année Sortie:</label>
    <input type="text" name="anneeSortie" required minlength="4" maxlength="4" size="4">
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Durée :  [      ]                    |  -->
    <!-- +----------------------------------------+  -->
    <label for="duree">Durée:</label>
    <input type="text" name="duree" required minlength="3" maxlength="4" size="4">
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Etoile :  [      ]                   |  -->
    <!-- +----------------------------------------+  -->
    <label for="etoile">étoile (optionnel) :</label>
    <input type="etoile" name="etoile" minlength="1" maxlength="1" size="1">
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Synopsis :  [      ]                 |  -->
    <!-- +----------------------------------------+  -->
    <label for="synopsis">Synopsis (optionnel) :</label><br>
    <textarea name="synopsis" cols="40" rows="5"></textarea>
    <br><br>

    <!-- +----------------------------------------+  -->
    <!-- |   Affiche :  [      ]                  |  -->
    <!-- +----------------------------------------+  -->
    <label for="file"> Affiche film :</label> 
    <input type="file" name="file" >
    <br><br>
    
    <!-- +----------------------------------------+  -->
    <!-- |  [ ajouter film ]                      |  -->
    <!-- +----------------------------------------+  -->
    <input type="submit" value="ajouter film" >

</form>

<?php
$titre = "Ajouter film";
$titreSecondaire = "Ajouter film";
$contenu = ob_get_clean();
require "template.php";