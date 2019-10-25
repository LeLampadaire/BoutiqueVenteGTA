<?php session_start();

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

    $erreur = 0;

    if(!empty($_GET)){
        $erreur = 1;
    }

    if(!empty($_POST)){
        $user = mysqli_query($bdd, 'SELECT * FROM users WHERE username="'. $_POST['username'] .'" AND password="'.md5($_POST['password']).'";');
        $donnees = mysqli_fetch_array($user, MYSQLI_ASSOC);

        if($donnees == NULL){
            header('Location: login.php?erreur=1');
        }else{
            $_SESSION['access'] = (int)$donnees['level'];
            header('Location: index.php');
        }
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

    <h1>Panel de connexion</h1>

    <div class="content-login">
        <div class="milieu-login">
            <div id="connexion">
                <form action="" method="POST">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit">
                </form>
                <?php 
                    if($erreur){
                        echo '<div class="alert alert-danger" role="alert">ID ou mot de passe incorrect !</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>