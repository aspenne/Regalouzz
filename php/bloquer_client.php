<?php
    session_start();
    if(!isset($_SESSION['admin'])){
        header('Location: Liste_Produit.php');
    }
    else{
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $valeurs = $_GET;
        $id = intval($valeurs['id_client']);
        $bloquer = $dbh->query("SELECT bloquer FROM Alizon._Client WHERE id_client = ".$id."", PDO::FETCH_ASSOC)->fetch();
        if($bloquer['bloquer']){
            $dbh->exec("UPDATE Alizon._Client SET bloquer = false WHERE id_client = ".$id."");
        }
        else{
            $dbh->exec("UPDATE Alizon._Client SET bloquer = true WHERE id_client = ".$id."");
        }
        header('Location: panel_admin.php');
    }
?>