<?php session_start();

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

    BlockAccessPage($_SESSION['access'], 3);

    $test = false;

    if(!empty($_POST['IP'])){
        mysqli_query($bdd, 'INSERT INTO banip(ip) VALUE(\''.$_POST['IP'].'\')');
        $test = true;
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite; ?> - BanIp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css" />
    <link rel="icon" type="image/gif" href="../uploads/favicon.ico" />
</head>
<body>
    <a href="../index.php"><img id="logo" src="../uploads/Ortega.png"></a>

    <div class="content-login">
        <div class="milieu-login">
            <form action="" method="POST">
                <input type="tex" name="IP" placeholder="Adresse IP">
                <input type="submit">
            </form>
            <?php
                if($test){
                    echo '<div class="alert alert-success" role="alert">IP ajoutée !</div>';
                }
            ?>

            <br><input type="button" value="Retour" onClick="document.location.href = 'index.php'" id="Retour"><br>
        </div>
    </div>
</body>
</html>