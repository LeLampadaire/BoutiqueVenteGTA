<?php session_start();

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

    if (empty($_GET['Id'])) {
        echo "Erreur d'ID !";
        exit();
    }
    
    BlockAccessPage($_SESSION['access'], 3);

    $article = mysqli_query($bdd, 'DELETE FROM Articles WHERE Id='.$_GET['Id']);

    header('Location: article-management.php');

?>