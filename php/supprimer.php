<?php
    session_start();

    if(isset($_SESSION["idclient"])){
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("DELETE FROM Alizon._panier WHERE id_produit = ? AND id_client = ?;");
        $res = $stmt->execute([$_GET['idproduit'],$_GET['idclient']]);
        header("location:panierT2.php");
    }
    else {
        $tab_cookies = unserialize($_COOKIE['panier']);
        unset($tab_cookies[$_GET['idproduit']]);
        setcookie('panier', serialize($tab_cookies), time()+3600*24*30);
        header("location:panier.php");
    }
?>