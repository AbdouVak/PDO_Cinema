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
        <a href="../index.php">Accueil</a>
        <a href="">Trier film</a>
        <a href="">Gestion</a>
    </nav>
    <div>
        <main>
            <div id="contenue">
                <h1>PDO cinema</h1>
                <h2>$titre_secondaire</h2>
                <?= $contenue ?>
            </div>
        </main>
    </div>
</body>
</html>