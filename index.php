<?php session_start();

    if (empty($_SESSION['Number_Produit'])) {
        $_SESSION['Number_Produit'] = 1;
    } 

    require 'tool.php';
    include 'configuration.php';
    require_once('bdd_connexion.php');
    BanIP($bdd);

    if(empty($_GET['categories'])){
        $article = mysqli_query($bdd, 'SELECT * FROM Articles');
    }else{
        $article = mysqli_query($bdd, 'SELECT * FROM Articles WHERE categorie='. $_GET['categories']);
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
<body class="container-fluid">
    <?php
        // Header
        include_once('header.php');
    ?>

    <div class="row">
    
        <div class="col-2">
            <div class="content">
                <div class="categories">
                    <h1>Menu</h1>
                    <a href="?categories=1" id="in_categories">Armes </a>
                    <a href="?categories=2" id="in_categories">Accessoires </a>
                    <a href="?categories=3" id="in_categories">Voitures </a>
                    <a href="?categories=4" id="in_categories">Ingrédients </a>
                    <a href="?categories=5" id="in_categories">Boissons </a>
                </div>   
            </div>    
        </div>   

        <div class="col-8">
            <div class="milieu">
                <?php foreach($article as $donnees){?>
                        <div class="block">
                            <img class='image_index' src='<?= $donnees['image'] ?>'>
                            <hr color="black">
                            <p>Nom : <?= $donnees['nom'] ?></p>
                            <p>Prix : <?= number_format($donnees['prix'], 2, ',', ' '); ?> $</p>
                            <form action="add_article.php?articles=<?= $donnees['Id'] ?>" method="POST">
                                <select id="number" name="number">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                                <input type="submit">
                            </form>
                        </div>
                <?php } ?>
            </div>
        </div>

        <div class="col-2">
            <div class="droite">
                <div class="login">
                    <br>
                    <a href="login.php" alt="" title="Commandes"><img id="login" src="uploads/login.png"></a>
                    <hr color="black" width="80%">
                    <p>Mes commandes</p>
                </div>
                <hr color="black">
                <div class="panier">
                    <a href="panier.php" alt="" title="Panier"> <img id="panier" src="uploads/caddie.png"></a>
                    <hr color="black" width="80%">
                    <p>Panier : <?= $_SESSION['Number_Produit'] -1 ?></p>
                </div>
            </div> 
        </div> 
            
    </div>
</body>
</html>