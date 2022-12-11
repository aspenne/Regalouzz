<?php

include('id.php');

$dbh=new PDO("$driver:host=$server;dbname=$dbname",$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->query("UPDATE Alizon._produit set masquer=false where id_produit=".$_GET['ID']);

header('Location: ./detail_produit.php?ID='.$_GET['ID']);

?>