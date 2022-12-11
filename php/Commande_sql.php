<?php
session_start();
include('id.php');
$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

//$dbh->exec("INSERT INTO alizon._commande (id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) VALUES (".$_SESSION['id_client'].",".$_SESSION['Adresse'].",".$_SESSION['Livraison'].",CURRENT_DATE,110,10)");
$dbh->exec("INSERT INTO alizon._commande (id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) VALUES (".$_SESSION['id_client'].",4,4,CURRENT_DATE,110,10)");
$id_commande=$dbh->lastInsertId();

$panier = $dbh->query("SELECT * from alizon._panier natural join alizon.produit where id_client = ".$_SESSION['id_client']."",PDO::FETCH_ASSOC);
foreach($panier as $article){
    $dbh->exec("INSERT INTO alizon._detailcommande (id_commande, id_produit, quantite, prix_ttc) VALUES (".$id_commande.",".$article['id_produit'].",".$article['quantite'].",".$article['prix_ttc'].")");
}

$dbh->exec("Delete from alizon._panier where id_client = ".$_SESSION['id_client']."");

header('Location: ./recap.php?id='.$id_commande.'');

?>
