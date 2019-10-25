<?php session_start();

    require 'tool.php';
    include 'configuration.php';
    require_once('bdd_connexion.php');
    BanIP($bdd);

    if(!empty($_POST)){
        $commande = mysqli_query($bdd, 'SELECT * FROM commandes WHERE id='. $_POST['Id'].' AND password="'.$_POST['password'].'";');
        $donnees = mysqli_fetch_array($commande, MYSQLI_ASSOC);

        if($donnees == NULL){
            header('Location: login.php?erreur=1');
        }
    }else{
        header('Location: login.php?erreur=1');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite; ?></title>
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

    <table>
        <tbody>
            <tr>
                <th>Date</th>
                <th>Heure</th>
                <th>&nbsp;Nom / pr&eacute;nom</th>
                <th>&nbsp;Prix</th>
                <th>Lieu</th>
                <th>Validation</th>
                <th>La commande</th>
            </tr>

            <tr>
                <td><?= htmlspecialchars(AffichageDateEurope($donnees['date']), ENT_QUOTES); ?></td>
                <td><?= htmlspecialchars($donnees['heure'], ENT_QUOTES); ?></td>
                <td><?= htmlspecialchars($donnees['nomPrenom'], ENT_QUOTES); ?></td>
                <td><?= number_format($donnees['prixTotal'], 2, ',', ' '); ?> $</td>
                <td><?= htmlspecialchars($donnees['lieu'], ENT_QUOTES); ?></td>
                <td><div style="display:block; width: 180px;"><?php 
                    if ($donnees['valider'] == 1) {
                        echo "<p style='background-color: green;'>Validé !";
                    } else if ($donnees['valider'] == 2){
                        echo "<p style='background-color: red;'>Réfusé !";
                    } else {
                        echo "<p style='background-color: orange;'>En attente d'acceptation !";
                    } ?> </p></div></td>
                <td><?= $donnees['commande'] ?></td>
            </tr>
        </tbody>
    </table>
    <div class="text-center">
        <i class="text-white">Pour tout refus de la commande, merci de contacter <u><?= $contact ?></u> sur discord.</i><br>
        <input type="button" value="Retour" onClick="window.location.href='index.php'" id="Retour">
    </div>
</body>
</html>