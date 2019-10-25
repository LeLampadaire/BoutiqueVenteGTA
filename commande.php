<?php session_start();

    if (empty($_SESSION['Number_Produit'])) {
        $_SESSION['Number_Produit'] = 1;
    } 

    require 'tool.php';
    include 'configuration.php';
    require_once('bdd_connexion.php');
    BanIP($bdd);

    if ($_SESSION['Number_Produit'] == 1) {
        header("Location: erreur/paniervide.php");
    } 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite ?> - Commande</title>
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

    <h1>Informations pour la commande :</h1>

    <div class="content-commande">
        <div class="milieu-commande">
            <form method="POST" action="validation_achat.php">
                <br><div><p style="color: white;">Votre nom et prénom : <input type="text" name="name" placeholder="Votre nom et prénom" required></p></div>
                <div><p style="color: white;">La date pour la commande : <input type="date" name="date" placeholder="La date du rendez-vous" required></p></div>
                <div><p style="color: white;">L'heure du rendez-vous : <input type="time" name="time" placeholder="L'heure du rendez-vous" required></p></div>
                <div><p style="color: white;">Lieu du rendez-vous : <select name="lieu" required>
                    <option value="Concessionnaire">Concessionnaire</option>
                    <option value="Ammunation">Ammunation</option>
                    <option value="Tequila-la">Tequila-la</option>
                    <option value="Bahamas">Bahamas</option>
                    <option value="Unicorn">Unicorn</option>
                    <option value="Foodtruck">Foodtruck</option>
                </select></p></div>
                <div><input type="submit" style="margin-top: 10px"></div><br>
                <input type="button" value="Retour" id="Retour-panier" onClick="document.location.href = document.referrer"><br><br>
            </form>
        </div>
    </div>
</body>
</html>



