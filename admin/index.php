<?php session_start();

    if (empty($_SESSION['access'])) {
        header('Location: login.php');
    } else if ($_SESSION['access'] < 1) {
        header('Location: login.php');
    }

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite; ?> - Panel Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css" />
    <link rel="icon" type="image/gif" href="../uploads/favicon.ico" />
</head>
<body>
    <a href="../index.php"><img id="logo" src="../uploads/Ortega.png"></a>

    <h1>Panel Admin</h1>

    <form method="POST" action="add_article.php">
        <div id="article">
            <h3>Ajouter un article :</h3>

            <select id="categorie" name="categorie" <?= BlockInputByLevel($_SESSION['access'], 3 )?>>
                <option value="1">Armes</option>
                <option value="2">Accessoires</option>
                <option value="3">Voitures</option>
                <option value="4">Ingrédients</option>
                <option value="5">Boissons</option>
            </select>
            <div><input type="text" name="file" placeholder="Url de l'image" <?= BlockInputByLevel($_SESSION['access'], 3 )?>></div>
            <div><input type="text" name="nom" placeholder="Nom de l'objet" <?= BlockInputByLevel($_SESSION['access'], 3 )?>></div>
            <div><input type="text" name="prix" placeholder="Prix de l'objet" <?= BlockInputByLevel($_SESSION['access'], 3 )?>></div>
            <input type="submit" <?= BlockInputByLevel($_SESSION['access'], 3 )?>>
        </div>
    </form>

    <div id="page">
        <h3> Pages :</h3>
        <div><a href="commandes.php"><button class="button">Commande</button></a></div><br>
        <div><a href="article-management.php"><button class="button">Supprimer des articles</button></a></div><br>
        <div><a href="ban-ip.php"><button class="button">Bannir</button></a></div><br>
        <div><a href="../index.php"><button class="button">Le site</button></a></div><br>
        <div><a href="deconnexion.php"><button class="button">Déconnexion</button></a></div>
    </div>
</body>
</html>

