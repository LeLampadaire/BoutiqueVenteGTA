<?php session_start();

    if (empty($_SESSION['Number_Produit'])) {
        $_SESSION['Number_Produit'] = 1;
    } 

    require 'tool.php';
    include 'configuration.php';
    require_once('bdd_connexion.php');
    BanIP($bdd);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite ?> - Panier</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/main.css" />
    <link rel="icon" type="image/gif" href="uploads/favicon.ico" />
</head>
<body>
    <?php
        // Header
        include_once('header.php');
    ?>

    <h1>Votre panier :</h1>

    <div class="content-panier">
    <div class="milieu-panier">
        
        <br><p style="color: white;">Objet dans le panier : <?= $_SESSION['Number_Produit'] -1 ?></p>

        <table>
            <tbody>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                </tr>
                <?php
                    $prixTotal = 0;

                    for($i=1; $i < $_SESSION['Number_Produit']; $i++): $prixTotal += ((int)GetPrixById($_SESSION["'". $i ."'"])); ?>
                <tr>
                    <td><?= GetNameById($_SESSION["'". $i ."'"]) ?></td>
                    <td><?= number_format(GetPrixById($_SESSION["'". $i ."'"]), 2, ',', ' '); ?> $</td>
                </tr>
                    <?php endfor; ?>
            </tbody>
        </table>
        <p style="color: white;">
        <?php 
            echo "Prix total : ";
            echo number_format($prixTotal, 2, ',', ' ')." $";
        ?>
        </p>
            <a href="commande.php"><button class="commander" style="vertical-align:middle"><span>Commandé !</span></button></a>
            <a href="destroy.php"><button class="vider">Videz le panier !</button></a>
            <br><br><br><br><input type="button" value="Retour" id="Retour-panier" onClick="window.location.href='index.php'"><br><br>
    </div>
    </div>
</body>
</html>