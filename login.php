<?php
    require 'tool.php';
    include 'configuration.php';
    require_once('bdd_connexion.php');
    BanIP($bdd);

    $erreur = 0;

    if(!empty($_GET)){
        $erreur = 1;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite ?></title>
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

    <div class="content-login">
        <div class="milieu-login">
            <form action="view-commande.php" method="POST">
                <br>
                <div><p style="color: white;">ID : <input type="text" placeholder="ID" name="Id"></p></div>
                <div><p style="color: white;">Mot de passe : <input type="password" placeholder="Password" name="password"></p></div>
                <div><input type="submit"></div>
                <br>
            </form>
            <?php 
                if($erreur){
                    echo '<div class="alert alert-danger" role="alert">ID ou mot de passe incorrect !</div>';
                }
            ?>
            <input type="button" value="Retour" id="Retour-panier" onClick="window.location.href='index.php'"><br><br>
        </div>
    </div>
</body>
</html>