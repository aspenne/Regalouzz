<?php
session_start();
include('id.php');

try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if (isset($_POST['num'])) {
        $num= $_POST['num'];
        $rue = $_POST['rue'];
        $ville= $_POST['ville'];
        $postal= $_POST['postal'];
        $pays = $_POST['pays'];
       
        $dbh->exec("INSERT INTO alizon._adresse(num, rue, ville, code_postal, pays, id_client) VALUES ('$num', '$rue', '$ville', '$postal', '$pays', '".$_SESSION["id_client"]."')");
        header('Location: page_adr.php');
        }




?> 
