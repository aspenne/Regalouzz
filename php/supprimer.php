<?php
    session_start();

    if(isset($_SESSION["id_client"])){
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // supprime dans le panier le produit x pour le client connecté 
        $stmt = $dbh->prepare("DELETE FROM Alizon._panier WHERE id_produit = ? AND id_client = ?;");
        $res = $stmt->execute([$_GET['id_produit'],$_SESSION['id_client']]);
        header("location:panier.php");
    }
    else {
        $tab_cookies = unserialize($_COOKIE['panier']);
        unset($tab_cookies[$_GET['id_produit']]);
        if(empty($tab_cookies)){
            echo'true';
            setcookie('panier',serialize($tab_cookies),time()-3600);
        }
        else {
            echo'false';
            setcookie('panier',serialize($tab_cookies),time()+3600*24*30);
        }
        header("location:panier.php");
    }
?>