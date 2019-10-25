<?php

    function BlockInputByLevel($levelaccess, $levelautorisation){
        if ($levelaccess < $levelautorisation) {
            return 'disabled';
        } else {
            return NULL;
        }
    }

    function BlockAccessPage($levelaccess, $levelautorisation){
        if ($levelaccess < $levelautorisation) {
            header('Location: javascript:history.back()');
            exit();
        } 
    }

    function BanIP($bdd){     
        $test = mysqli_query($bdd, 'SELECT ip FROM banip WHERE ip=\''.$_SERVER['REMOTE_ADDR'].'\'');
        $test = mysqli_fetch_array($test, MYSQLI_ASSOC);

        if($test != NULL){
            header("Location: ../erreur/banni.php");
            exit();
        }
        
        unset($bdd);
    }
?>