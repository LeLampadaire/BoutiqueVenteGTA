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

    $commande = mysqli_query($bdd, 'SELECT * FROM commandes ORDER BY id DESC;');

    function AffichageDateEurope($date){
        $dateSpliter = explode('-', $date, 3);
        return $dateSpliter[2].'/'.$dateSpliter[1].'/'.$dateSpliter[0];
    }

    function IntToInfo($Statut){
        if ($Statut == 0) {
            return 'En-attente';
        } else if ($Statut == 1) {
            return 'Valide';
        } else if ($Statut == 2){
            return 'Refus';
        } else {
            return 'Error-unknow';
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $nomSite; ?> - Commandes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../css/admin.css" />
    <link rel="icon" type="image/gif" href="../uploads/favicon.ico" />
</head>
<body>
    <a href="../index.php"><img id="logo" src="../uploads/Ortega.png"></a>

    <h1>Les commandes :</h1>

    <div class="content-commandes">
    <div class="milieu-commandes">
    <br><input type="button" value="Retour" onClick="window.location.href='index.php'" id="Retour"><br>


    <table id="table">
        <tbody>
            <tr>
                <th>Date de commande</th>
                <th>Date de livraison</th>
                <th>Heure</th>
                <th>&nbsp;Nom / pr&eacute;nom</th>
                <th>&nbsp;Prix</th>
                <th>Lieu</th>
                <th>Validation</th>
                <th>Visualiser la commande</th>
                <th>IP</th>
            </tr>
            <?php foreach($commande as $donnees){ ?>
            <tr>
                <td><?= date('d/m/Y', $donnees['dateCommande']) ?></td>
                <td><?= htmlspecialchars(AffichageDateEurope($donnees['date']), ENT_QUOTES); ?></td>
                <td><?= htmlspecialchars($donnees['heure'], ENT_QUOTES); ?></td>
                <td><?= htmlspecialchars($donnees['nomPrenom'], ENT_QUOTES);  ?></td>
                <td style="width: 120px;"><?= number_format($donnees['prixTotal'], 2, ',', ' '); ?> $</td>
                <td><?= htmlspecialchars($donnees['lieu'], ENT_QUOTES); ?></td>                
                <td id="<?= IntToInfo($donnees['valider']); ?>"></td>
                <td><a href="commande-view.php?Id=<?= $donnees['Id'] ?>">Visualiser</a></td>
                <td><?= $donnees['IP'] ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <input type="button" value="Retour" onClick="window.location.href='index.php'" id="Retour"><br><br>

    </div>
    </div>
</body>
</html>