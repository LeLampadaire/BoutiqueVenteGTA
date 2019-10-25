<?php session_start();

    if (empty($_SESSION['Number_Produit'])) {
        header('Location: commande.php');
        exit();
    }

    require 'tool.php';
    include 'configuration.php';
    require_once('bdd_connexion.php');
    BanIP($bdd);

    if (empty($_POST['name'])) {
        echo "Votre nom n'est pas présent.";
        exit(0);
    } else if (empty($_POST['date'])) {
        echo "La date n'est pas présent.";
        exit(0);
    } else if (empty($_POST['time'])) {
        echo "L'heure n'est pas présent.";
        exit(0);
    } else if (empty($_POST['lieu'])) {
        echo "Le lieu n'est pas présent.";
        exit(0);
    } else {
        $prixTotal = 0;
        $listeDesAchats = "";

        for ($i=1; $i < $_SESSION['Number_Produit']; $i++) { 
            $listeDesAchats .= "Produit : ". GetNameById($_SESSION["'". $i ."'"]) . " | Prix : ". GetPrixById($_SESSION["'". $i ."'"]) ." $<br>";
            $prixTotal += (int)GetPrixById($_SESSION["'". $i ."'"]);
        }

        $password = GeneratorPasswd(8);
        $lieu = $_POST['lieu'];
        $nomPrenom = $_POST['name'];
        $date = $_POST['date'];
        $heure = $_POST['time'];
        $id = GetId('Commandes', $bdd);
        $dateCommande = new DateTime();
        
        session_destroy();

        $commande = mysqli_query($bdd, 'INSERT INTO Commandes VALUES('.$id.',0,\''.$listeDesAchats.'\',\''.$password.'\',\''.$lieu.'\',\''.$nomPrenom.'\',\''.$date.'\','.$dateCommande->getTimestamp().',\''.$heure.'\','.$prixTotal.',\''.$_SERVER['REMOTE_ADDR'].'\')');   

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite ?> - Validation</title>
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

    <h1>Commande enregistrée !</h1>

    <div class="content-validation_achat">
    <div class="milieu-validation_achat">
        <br><p style="color: white; background-color: red;"> Sauvegarder ces informations : <br> 
        <div class="informations" style="padding: 10px;">ID : <?php echo $id; ?><br>
        Mot de passe : <?php echo $password; ?></div><br>
        </p>

        <p style="font-size:22px; color: white;"> Pour vérifier si votre commande a bien été accepté, rendez-vous dans la partie > <a href="login.php" style="text-decoration:none; color:red; border: 1px solid red;">commande</a> < .</p><br>
    </div>
    </div>
</body>
</html>

<?php } ?>