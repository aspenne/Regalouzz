<?php
    session_start();

    if(isset($_SESSION["id_client"])){
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE alizon._panier SET quantite = ? WHERE id_client = ? AND id_produit = ?");
        $res = $stmt->execute([$_GET['quantite'],$_SESSION['id_client'],$_GET['id_produit']]);
        header("location:panier.php");
    }
    else {
        $tab_cookies = unserialize($_COOKIE['panier']);
        $tab_cookies[$_GET['id_produit']] = $_GET['quantite'];
        setcookie('panier', serialize($tab_cookies), time()+3600*24*30);
        header("location:panier.php");
    }
?>