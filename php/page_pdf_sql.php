<?php
    session_start();
    include('id.php');

    try {
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $stmt = $dbh->query("SELECT * from alizon._retour where id_commande =".$_SESSION['id_commande']."", PDO::FETCH_ASSOC);
        $abc = $stmt->fetchAll(); 
        $def = $dbh->query("SELECT * from alizon._detailcommande where id_commande =".$_SESSION['id_commande']."", PDO::FETCH_ASSOC);
        $ghi = $def->fetchAll();

        foreach ($abc as $row) {
            $produit = $row['id_produit'];
            foreach ($ghi as $prod){
                if ($produit == $prod['id_produit']){
                    echo "quantite ret  ". $row['quantite']."<br>";
                    echo "quantite base " . $prod['quantite']."<br>";
                    echo "id prod " . $prod['id_produit']."<br>";
                    echo "id ret " . $row['id_produit']."<br>";
                    $newQuant =  $prod['quantite'] - $row['quantite'] ;
                    echo "new quant " . $newQuant."<br>";
                    // if ($newQuant <= 0){
                    //     $dbh->exec("DELETE FROM alizon._detailcommande where id_commande =".$_SESSION['id_commande']." and id_produit =".$prod['id_produit']."");
                    // }
                    // else{
                    //     $dbh->exec("UPDATE alizon._detailcommande set quantite = ".$newQuant." where id_commande =".$_SESSION['id_commande']." and id_produit =".$prod['id_produit']."");
                    // }
                }
            }
        }
        
        unset($_SESSION['total']);
        unset($_SESSION['heure']);
        unset($_SESSION['id_commande']);


        header('Location: Liste_produit.php');

    }

    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
