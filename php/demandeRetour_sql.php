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

    if (isset($_POST['raisonHidden'])) {
        $id_client = $_SESSION["id_client"];
        $id_commande = $_POST['id_commande'];
        $raison = $_POST['raisonHidden'];
        $quantite = $_POST['quantiteHidden'];
        $id_produit = $_POST['idProduitHidden'];

        $date = date("d-m-Y");


        $_SESSION['total'] = $_POST['totalHidden'];
        $_SESSION['heure'] = date("H:i:s");

        $raisonList = explode(";", $raison);
        $quantiteList = explode(";", $quantite);
        $id_produitList = explode(";", $id_produit);

        for($i = 0; $i < count($raisonList)-1; $i++) {
            $dbh->exec("INSERT INTO alizon._retour (id_commande, id_client, raison, quantite, id_produit, date_ret, heure) VALUES (".$id_commande.",".$id_client.",'$raisonList[$i]','$quantiteList[$i]', '$id_produitList[$i]', '$date', '".$_SESSION['heure']."')");
        }   
        header('Location: retourPaiement.php');
            
    }
    else {
        header('Location: demande_retour.php');
    }
    
?>    