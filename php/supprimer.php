<?php
    session_start();

    if(isset($_SESSION["id_client"])){
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("DELETE FROM Alizon._panier WHERE id_produit = ? AND id_client = ?;");
        $res = $stmt->execute([$_GET['idproduit'],$_SESSION['idclient']]);
        header("location:panier.php");
    }
    else {
        $tab_cookies = unserialize($_COOKIE['panier']);
        unset($tab_cookies[$_GET['idproduit']]);
        setcookie('panier', serialize($tab_cookies), time()+3600*24*30);
        header("location:panier.php");
    }
?>