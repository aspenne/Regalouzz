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
        $dbh->query("UPDATE alizon._adresse SET num = '$num', rue = '$rue', ville = '$ville', code_postal = '$postal', pays = '$pays' WHERE id_client='".$_GET["id_client"]."' and id_adresse ='".$_POST['id']."'");
        header('Location: page_adr_admin.php?id_client='.$_GET["id_client"]);
        }




?> 