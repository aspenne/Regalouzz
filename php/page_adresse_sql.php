<?php
session_start();
include('id.php');

try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if (isset($_POST['adresse'])) {
        $adresse = $_POST['adresse'];
        $num= $_POST['rue'];
        $ville= $_POST['ville'];
        $postal= $_POST['postal'];

        if (!empty($adresse) && !empty($rue) && !empty($ville) && !empty($postal)) {
            $dbh->query("UPDATE alizon._adresse SET num = '$num', rue = '$adresse', ville = '$ville', code_postal = '$postal' WHERE id_client = '".$_SESSION["id_client"]."'");
            header('Location: profil.php');
        }

        else {
            echo "Veuillez remplir tous les champs";
        }
        
    }
header('Location: profil.php');
?>