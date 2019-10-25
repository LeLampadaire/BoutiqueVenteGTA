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

    $commande = mysqli_query($bdd, 'UPDATE Commandes SET valider = \'2\' WHERE Id='. $_GET['Id']);

    header('Location: commandes.php');
?>

