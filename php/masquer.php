<?php

include('id.php');

$dbh=new PDO("$driver:host=$server;dbname=$dbname",$user,$pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->exec("UPDATE Alizon._produit set masquer=true where id_produit=".$_GET['ID']);

header('Location: ./detail_produit.php?ID='.$_GET['ID']);

?>