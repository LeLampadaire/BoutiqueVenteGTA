<?php

    function GetId($database = null){
        include('bdd_connexion.php');
        $requete = mysqli_query($bdd, 'SELECT COUNT(Id) as countid FROM '.$database);
        $nbligne = mysqli_fetch_array($requete, MYSQLI_ASSOC);
        unset($bdd);
        return $nbligne['countid'] + 1;
    }

    function GeneratorPasswd($taille = 16){
        $mdp = "";
        for ($i=0; $i < $taille; $i++) { 
            $mdp .= chr(random_int(33, 126));
        }
        return $mdp;
    }
    
    function AffichageDateEurope($date){
        $dateSpliter = explode('-', $date, 3);
        return $dateSpliter[2].'/'.$dateSpliter[1].'/'.$dateSpliter[0];
    }

    function GetNameById($Id){
        include('bdd_connexion.php');
        $article = mysqli_query($bdd, 'SELECT * FROM Articles WHERE Id='. $Id);
        $article = mysqli_fetch_array($article, MYSQLI_ASSOC);
        unset($bdd);
        return $article['nom'];
    }

    function GetPrixById($Id){
        include('bdd_connexion.php');
        $article = mysqli_query($bdd, 'SELECT * FROM Articles WHERE Id='. $Id);
        $donnees = mysqli_fetch_array($article, MYSQLI_ASSOC);
        unset( $bdd );
        return $donnees['prix'];
    }

    function BanIP($bdd){     
        $test = mysqli_query($bdd, 'SELECT ip FROM banip WHERE ip=\''.$_SERVER['REMOTE_ADDR'].'\'');
        $test = mysqli_fetch_array($test, MYSQLI_ASSOC);

        if($test != NULL){
            header("Location: erreur/banni.php");
            exit();
        }
        
        unset($bdd);
    }

?>