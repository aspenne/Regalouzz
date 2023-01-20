<?php 
session_start();
include('id.php');

try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $idClient = $_POST["idClientHidden"];
    $idCommande = $_POST["idCommandeHidden"];
    $date = $_POST["dateHidden"];
    $heure = $_POST["heureHidden"];

    $stmt = $dbh->prepare("SELECT * FROM alizon._bonTemp where id_client = ? and id_bon = ? and date_bon = ? and heure_bon = ?");
    $stmt->execute([$idClient, $idCommande, $date, $heure]);
    $abc = $stmt->fetchAll(); 

    if (count($abc) == 0) {
        $stmt = $dbh->prepare("DELETE FROM alizon._retour where id_client = ? and date_ret= ? and heure = ?");
        $stmt->execute([$idClient, $date, $heure]);
        header('Location: retour_comm_vendeur.php');
    }
    else{
    foreach($abc as $row){
        $val =  $row['valeur'];
        $code = $row['code'];
    }

    $stmt = $dbh->prepare("INSERT INTO alizon._bon (id_client, code, valeur) VALUES (?, ?, ?)");
    $stmt->bindValue(1, $idClient, PDO::PARAM_INT);
    $stmt->bindValue(2, $code, PDO::PARAM_STR);
    $stmt->bindValue(3, $val, PDO::PARAM_INT);
    $stmt->execute();

    $stmt = $dbh->prepare("DELETE FROM alizon._bonTemp where id_client = ? and id_bon = ? and date_bon = ? and heure_bon = ?");
    $stmt->execute([$idClient, $idCommande, $date, $heure]);

    $stmt = $dbh->prepare("DELETE FROM alizon._retour where id_client = ? and date_ret= ? and heure = ?");
    $stmt->execute([$idClient, $date, $heure]);
    
    header('Location: retour_comm_vendeur.php');
}
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>