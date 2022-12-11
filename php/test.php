<?php
session_start();
include('id.php');
$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$panier = $dbh->query("SELECT * from alizon._panier natural join alizon.produit where id_client = ".$_SESSION['id_client']."",PDO::FETCH_ASSOC);
foreach($panier as $article){
    echo'<pre>';
    print_r($article);
    echo'</pre>';
    //$dbh->exec("INSERT INTO alizon._detailcommande (id_commande, id_produit, quantite, prix_ttc) VALUES (".$id_commande.",".$article['id_produit'].",".$article['quantite'].",".$article['prix'].")");
}

?>