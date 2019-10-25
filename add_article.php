<?php session_start();
	
    if (empty($_SESSION['Number_Produit'])) {
        $_SESSION['Number_Produit'] = 1;
    } 

    if (empty($_POST['number'])) {
        $count = 1;
    } else {
        $count = (int)$_POST['number'];
    }

    for ($i=0; $i < $count; $i++) { 
        $_SESSION["'".strval($_SESSION['Number_Produit'])."'"] = $_GET['articles'];
        $_SESSION['Number_Produit'] += 1;
    }
    
    if (isset($_SERVER["HTTP_REFERER"])) {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    } else {
        header('Location: javascript:history.back()');
    }
?>