<?php
session_start();
include('id.php');
$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));


$numRue1 = $_SESSION['numRue'];
$codePost1 = $_SESSION['codePost'];
$adr1 = $_SESSION['adr'];
$ville1 = $_SESSION['ville'];
$pays1 = $_SESSION['pays'];

$numRue2 = $_SESSION['numRue2'];
$codePost2 = $_SESSION['codePost2'];
$adr2 = $_SESSION['adr2'];
$ville2 = $_SESSION['ville2'];
$pays2 = $_SESSION['pays2'];

$idClient = $_SESSION["id_client"];
$tot = $_SESSION['total'];
if(isset($_SESSION['reduction'])){
    $red = $_SESSION['reduction'];
    $redTot = $_SESSION['reducTot'];
    $tempCode = $_SESSION["Code"];
}



if(($numRue1 != $numRue2) || ($adr1 != $adr2) || ($ville1 != $adr2) || ($codePost1 != $codePost2) || ($pays1 != $pays2)){
    $existe1 = $dbh->query("Select count(id_adresse) from Alizon._adresse WHERE num='$numRue1' AND rue='$adr1' AND ville='$ville1' AND code_postal='$codePost1' AND pays='$pays1' AND id_client='$idClient'", PDO::FETCH_ASSOC)->fetch();
    $existe2 = $dbh->query("Select count(id_adresse) from Alizon._adresse WHERE num='$numRue2' AND rue='$adr2' AND ville='$ville2' AND code_postal='$codePost2' AND pays='$pays2' AND id_client='$idClient'", PDO::FETCH_ASSOC)->fetch();
    if($existe1['count'] == 0){
        $dbh->exec("insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values ('$numRue1','$adr1','$ville1','$codePost1','$pays1','$idClient')");
        $idAdrlivr = $dbh->lastInsertId();
    }
    else{
        $temp = $dbh->query("Select id_adresse from Alizon._adresse WHERE num='$numRue1' AND rue='$adr1' AND ville='$ville1' AND code_postal='$codePost1' AND pays='$pays1' AND id_client='$idClient'", PDO::FETCH_ASSOC)->fetch();
        foreach($temp as $ligne){
            $idAdrlivr = $ligne;
        }

    }
    if($existe2['count'] == 0){
        $dbh->exec("insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values ('$numRue2','$adr2','$ville2','$codePost2','$pays2','$idClient')");
        $idAdrfact = $dbh->lastInsertId();

    }
    else{
        $temp = $dbh->query("Select id_adresse from Alizon._adresse WHERE num='$numRue2' AND rue='$adr2' AND ville='$ville2' AND code_postal='$codePost2' AND pays='$pays2' AND id_client='$idClient'", PDO::FETCH_ASSOC)->fetch();
        foreach($temp as $ligne){
            $idAdrfact = $ligne;
        }

    }
}
else{
    $existe1 = $dbh->query("Select count(id_adresse) from Alizon._adresse WHERE num='$numRue1' AND rue='$adr1' AND ville='$ville1' AND code_postal='$codePost1' AND pays='$pays1' AND id_client='$idClient'", PDO::FETCH_ASSOC)->fetch();
    $cptAdr = 1;

    if($existe1['count'] == 0){

        $dbh->exec("insert into Alizon._Adresse(num,rue,ville,code_postal,pays,ID_Client) values ('$numRue1','$adr1','$ville1','$codePost1','$pays1','$idClient')");
        $idAdrfact = $dbh->lastInsertId();
    }
    else{
        $idAdrfact = $dbh->query("Select id_adresse from Alizon._adresse WHERE num='$numRue2' AND rue='$adr2' AND ville='$ville2' AND code_postal='$codePost2' AND pays='$pays2' AND id_client='$idClient'", PDO::FETCH_ASSOC)->fetch();

    }
    $idAdrlivr = $idAdrfact;
}
echo("</br>adresse facturation : $idAdrfact </br>Adresse livraison : $idAdrlivr </br>");

//$dbh->exec("INSERT INTO alizon._commande (id_client, adressefact, adresselivr, date_commande, prix_total, frais_port) VALUES (".$_SESSION['id_client'].",".$_SESSION['Adresse'].",".$_SESSION['Livraison'].",CURRENT_DATE,110,10)");
if(isset($_SESSION['reduction'])){
    $dbh->exec("INSERT INTO Alizon._commande (id_client, adressefact, adresselivr, date_commande, prix_total, frais_port, valBon) VALUES ('$idClient','$idAdrfact','$idAdrlivr',CURRENT_DATE,'$tot',5, '$red')");
    $id_commande=$dbh->lastInsertId();
    $rest = $redTot - $red;
    $dbh->exec("UPDATE  Alizon._bon SET valeur = $rest WHERE id_client = '$idClient' AND code = '$tempCode';");
    
}
else{
    $dbh->exec("INSERT INTO Alizon._commande (id_client, adressefact, adresselivr, date_commande, prix_total, frais_port, valBon) VALUES ('$idClient','$idAdrfact','$idAdrlivr',CURRENT_DATE,'$tot',5,0)");

    $id_commande=$dbh->lastInsertId();

}



$panier = $dbh->query("SELECT * from alizon._panier natural join alizon.produit where id_client = ".$_SESSION['id_client']."",PDO::FETCH_ASSOC);
foreach($panier as $article){
    $dbh->exec("INSERT INTO Alizon._detailcommande (id_commande, id_produit, quantite, prix_ttc) VALUES (".$id_commande.",".$article['id_produit'].",".$article['quantite'].",".$article['prix_ttc'].")");
    $nouvQ = $article['quantite_stock'] - $article['quantite'] ;
    $dbh->exec("UPDATE  Alizon._produit SET quantite_stock = '$nouvQ' WHERE id_produit = ".$article['id_produit'].";");
}


header('location:./recap.php');

?>



