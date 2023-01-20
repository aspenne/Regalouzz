<?php
session_start();
if(!isset($_SESSION['admin']) or $_SESSION['admin'] != TRUE){
    header("location:./Liste_produit.php");
}
include('id.php');

try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if (isset($_POST['mail'])) {
        $mail = $_POST['mail'];
        $tel= $_POST['tel'];

        if (!empty($mail) && !empty($tel)) {
            $dbh->query("UPDATE alizon._client SET mail = '$mail', tel = '$tel' WHERE id_client = '".$_GET["id_client"]."'");
            header('Location: modifier_client.php?id_client='.$_GET["id_client"]);
        }

        else {
            echo "Veuillez remplir tous les champs";
        }
        
    }

header('Location: modifier_client.php?id_client='.$_GET["id_client"]);