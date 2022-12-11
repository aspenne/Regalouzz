<?php
    session_start();

    if(isset($_SESSION["id_client"])){
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        // supprime de la liste de souhait le produit x pour le client connecté 
        $stmt = $dbh->prepare("DELETE FROM Alizon._listedesouhait WHERE id_produit = ? AND id_client = ?;");
        $res = $stmt->execute([$_GET['id_produit'],$_SESSION['id_client']]);
        
        header("location:souhait.php");
    }
?>