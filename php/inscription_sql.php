<?php
session_start();
include('id.php');


$valeurs = $_GET;

$nom = strval($valeurs['nom']);
$prenom = strval($valeurs['prenom']);
$email = strval($valeurs['email']);
$telephone = strval($valeurs['telephone']);
$date_naissance = strval($valeurs['date_naissance']);
$mdp = md5(strval($valeurs['mdp']));
$mdp1 = strval($valeurs['mdp1']);


echo $date_naissance;

$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$dbh->exec("INSERT INTO Alizon._client(nom, prenom, mail, tel, date_naissance, mot_de_passe) VALUES ('$nom', '$prenom', '$email', '$telephone', '$date_naissance', '$mdp')");
$id = $dbh->query("SELECT * FROM Alizon._Client WHERE mail='".$email."'", PDO::FETCH_ASSOC) -> fetch();
$_SESSION['id_client'] = $id['id_client'];

header('Location: Liste_produit.php');
?>