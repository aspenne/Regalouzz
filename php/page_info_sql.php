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

if (isset($_POST['mail'])) {
        $mail = $_POST['mail'];
        $mdp = $_POST['pass'];
        $tel= $_POST['tel'];

        if (!empty($mail) && !empty($mdp) && !empty($tel)) {
            $dbh->query("UPDATE alizon._client SET mail = '$mail', mot_de_passe = md5('$mdp'), tel = '$tel' WHERE id_client = '".$_SESSION["id_client"]."'");
            header('Location: profil.php');
        }

        else {
            echo "Veuillez remplir tous les champs";
        }
        
    }

header('Location: profil.php');