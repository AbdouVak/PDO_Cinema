<?php ob_start();?>

<p class="uk-label uk-label-warning"> Il y a <?=$requete->rowCount()?>films</p>

<table class="uk-table uk-table-striped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $film){ ?>
                <tr>
                    <td><?= $film["titre"] ?> </td>
                    <td><?= $film["anneeSortieFrance"] ?> </td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php
$titre = "Liste des films";
$titreSecondaire = "Liste des films";
$contenu = ob_get_clean();
require "View\template.php";