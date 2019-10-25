<?php session_start();

    require 'tool.php';
    include '../configuration.php';
    require_once('../bdd_connexion.php');
    BanIp($bdd);

    $article = mysqli_query($bdd, 'SELECT * FROM articles;');

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

    <h1>Suppression d'article</h1>

    <div class="content-article-management">
        <div class="milieu-article-management">
            <br><input type="button" value="Retour" onClick="window.location.href='index.php'" id="Retour"><br>

            <table id="table">
                <tbody>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Suppression</th>
                    </tr>
                    <?php foreach($article as $donnees){ ?>
                    <tr> 
                        <td><?= $donnees['nom'] ?></td>
                        <td><?= number_format($donnees['prix'], 2, ',', ' '); ?> $</td>
                        <td><a href="delete.php?Id=<?= $donnees['Id'] ?>"><button class="delete">Delete</button></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <input type="button" value="Retour" onClick="window.location.href='index.php'" id="Retour"><br><br>
        </div>
    </div>
    
</body>
</html>