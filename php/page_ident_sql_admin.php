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

if (isset($_POST['prenom'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];

        if (!empty($nom) && !empty($prenom) && !empty($date)) {
            $dbh->query("UPDATE alizon._client SET nom = '$nom', prenom = '$prenom', date_naissance = '$date' WHERE id_client = '".$_POST["id_client"]."'");
            header('Location: modifier_client.php?id_client='.$_POST["id_client"]);
        }

        else {
            echo "Veuillez remplir tous les champs";
        }
        
    }

    header('Location: modifier_client.php?id_client='.$_POST["id_client"]);
?>
