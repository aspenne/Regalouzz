<?php
    session_start();

    if(isset($_SESSION["id_vendeur"])){
        include('id.php');
        try {
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("UPDATE alizon._produit SET quantite_stock = quantite_stock + ? WHERE id_produit = ?");
            $res = $stmt->execute([$_POST['qte_commande'],$_POST['idproduit']]);
            $stmt = $dbh->prepare("UPDATE alizon._ReassortVendeur SET etat = 'livré' WHERE id_commande = ?");
            $res = $stmt->execute([$_POST['idcommande']]);
        header("location:historique_reassort.php");
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    else {
        header("location:Liste_produit_vendeur.php");
    }
?>
