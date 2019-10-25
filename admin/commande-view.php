<?php session_start();

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

    if (empty($_SESSION['access'])) {
        header('Location: login.php');
    } else if ($_SESSION['access'] < 1) {
        header('Location: login.php');
    }

    BlockAccessPage($_SESSION['access'], 2);

    if (empty($_GET['Id'])) {
        echo "Il n'y a pas d'ID.";
        exit();
    }

    $commande = mysqli_query($bdd, 'SELECT * FROM Commandes WHERE Id='. $_GET['Id']);
    $donnees = mysqli_fetch_array($commande, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css" />
    <link rel="icon" type="image/gif" href="../uploads/favicon.ico" />
</head>
<body>
    <a href="../index.php"><img id="logo" src="../uploads/Ortega.png"></a>

    <h1>Commande :</h1>

    <div class="content-commande-view">
    <div class="milieu-commande-view">
        <p style="color: white;"><?= $donnees['commande']; ?><p>
        <p style="color: white;" id="prixtotal">Prix total : <?= number_format($donnees['prixTotal'], 2, ',', ' '); ?> $</p>

        <a href="valid.php?Id=<?= $_GET['Id'] ?>"><button class="valid">Validé !</button></a>
        <a href="deny.php?Id=<?= $_GET['Id'] ?>"><button class="refus">Refusé !</button></a><br>
        <input type="button" value="Retour" onClick="document.location.href = document.referrer" id="Retour"><br><br>
    </div>
    </div>    
</body>
</html>