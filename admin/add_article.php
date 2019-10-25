<?php session_start();

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

    if(empty($_SESSION['access'])){
        header('Location: login.php');
    }else if ($_SESSION['access'] < 1){
        header('Location: login.php');
    }

    BlockAccessPage($_SESSION['access'], 3);
    
    function getId( $database = null){
        require_once('../bdd_connexion.php');
        $requete = mysqli_query($bdd, 'SELECT COUNT(id) as countid FROM '.$database);
        $nbligne = mysqli_fetch_array($requete, MYSQLI_ASSOC);
        unset($bdd);
        return $nbligne['countid'] + 1;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css" />
    <link rel="icon" type="image/gif" href="../uploads/favicon.ico" />
</head>
<body>
    <a href="../index.php"><img id="logo" src="../uploads/Ortega.png"></a>

    <div class="content-add_article">
        <div class="milieu-add_article">
            <p style="color: white;">
                <?php
                if (empty($_POST['nom'])) {
                    echo "nom n'est pas present.";
                    exit(0);
                } else if(empty($_POST['prix'])) {
                    echo "Il n'y a pas de prix.";
                    exit(0);
                } else if(empty($_POST['file'])) {
                    echo "Il n'y a pas d'image.";
                    exit(0);
                } else if(empty($_POST['categorie'])) {
                    echo "Il n'y a pas de categorie.";
                    exit(0);
                } else {
                    $result = mysqli_query($bdd, 'INSERT INTO Articles(categorie, nom, image, prix) values(\''. $_POST['categorie'] .'\',\''. $_POST['nom'] .'\',\''. $_POST['file'] .'\',\''. $_POST['prix'] .'\')');
                    
                    if($result){
                        echo "Article bien ajouté !";
                    } else{
                        echo "Erreur de l'ajout !";
                    }
                }
                
                ?>
            </p>
            <div><input type="button" value="Retour" onClick="document.location.href='index.php'" id="Retour"></div>
        </div>
    </div>
</body>
</html>