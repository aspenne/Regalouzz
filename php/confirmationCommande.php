<?php
    try {
        include("id.php");
        date_default_timezone_set("Europe/Paris");
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $stmt = $dbh->prepare("INSERT INTO Alizon._ReassortVendeur(id_produit,id_vendeur,date_commande,quantite,etat) VALUES (?,?,?,?,'en_cours')");
        $stmt->execute([$_GET["id_produit"],$_GET['id_vendeur'],date("Y-m-d"),$_GET['qte_commande']]);
        echo '<script type="text/javascript">
            alert("Votre réassort a été pris en compte");
            </script>';
        header('location:detail_produit.php?ID='.$_GET['id_produit']);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>