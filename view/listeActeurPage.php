<?php ob_start();?>



<?php
$titre = "Liste Acteur";
$titreSecondaire = "Liste Acteur";
$contenu = ob_get_clean();
require "template.php";