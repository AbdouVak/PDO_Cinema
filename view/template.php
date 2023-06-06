<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titre ?></title>
</head>

<body>
    <nav>
        <a href="index.php?action=homePage">Accueil</a>
        <a href="index.php?action=listFilms">liste film</a>
        <a href="index.php?action=ajouterPersonnePage">ajouter personne</a>
        <a href="index.php?action=ajouterCastingPage">ajouter casting</a>
    </nav>
    <div>
        <main>
            <div id="contenue">
                <h1>PDO cinema</h1>
                <h2><?= $titreSecondaire ?></h2>
                <?= $contenu  ?>
            </div>
        </main>
    </div>
</body>
</html>