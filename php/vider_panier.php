<?php
    session_start();

    

    if(isset($_SESSION['id_client'])){
        $id_client = $_SESSION['id_client'];
        include('id.php');
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->query("DELETE FROM Alizon._Panier WHERE id_client = $id_client");
        header('Location: panier.php');
    }else{
        //delete a cookie
        setcookie("panier", "", time() - 3600);
        header('Location: panier.php');
    }

?>