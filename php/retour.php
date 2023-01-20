<?php
session_start();
require('fpdf/fpdf.php'); // on inclut la librairie pdf
include('phpqrcode/qrlib.php'); //On inclut la librairie qrcode
include('id.php');

$lien='https://youtu.be/dQw4w9WgXcQ'; // Vous pouvez modifier le lien selon vos besoins
$code = QRcode::png($lien, 'image-qrcode.png'); // On crée notre QR Code
//echo '<img src="image-qrcode.png" alt="QR Code" />';

// Instanciation of inherited class
$pdf = new FPDF();
$pdf->AliasNbPages();

$pdf->AddPage('L','A4');

$pdf->Line(150, 5, 150, 200); // ligne verticale

//Partie gauche
$pdf->SetFont('Arial','B',25);
$pdf->Cell(90,10,utf8_decode('Retour Alizon'),0,1,'R');
$pdf->Ln(20);
$pdf->Image('image-qrcode.png',15,30,40); //decalage de 20 sur la gauche, 6 sur le haut, taille de 50
$pdf->SetFont('Arial','',12);
$num_client = "5";
$pdf->Cell(100,7,utf8_decode('Compte client :'.$num_client),0,1,'R');
$pdf->Cell(100,7,utf8_decode('Créé le :'.date('d/m/Y')),0,1,'R');
$pdf->Cell(100, 7, utf8_decode('Code : 1'),0,1,'R');
$pdf->Ln(20);

//Destinataires's form
$pdf->SetFont('Arial','',12);
$pdf-> Cell(1,7,"DESTINATAIRE ",0,1,'L');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,7,"ALIZON",0,1,'L');
$pdf->Cell(1,7,"SERVICE APRES VENTE",0,1,'L');
$pdf->Cell(1,7,"Rue Edouard Branly",0,1,'L');
$pdf->Cell(1,7,"22300 LANNION",0,1,'L');

//Sender's form
try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    $data = $dbh->query("SELECT * FROM alizon._client WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
    $data_adresse = $dbh->query("SELECT * from Alizon._adresse natural join alizon._commande  WHERE adresselivr = id_adresse and id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$pdf->Ln(20);

$pdf->SetFont('Arial','',12);
$pdf-> Cell(1,7,"EXPEDITEUR ",0,1,'L');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(1,7,utf8_decode($data['nom']." ".$data['prenom']),0,1,'L');
$pdf->Cell(1,7,utf8_decode($data_adresse['num']." ".$data_adresse['rue']),0,1,'L');
$pdf->Cell(1,7,utf8_decode($data_adresse['code_postal']." ".$data_adresse['ville']),0,1,'L');



//Partie droite
$pdf->Cell(275,-310,utf8_decode('Comment utiliser votre étiquette RETOUR ?'),0,0,'R');
$pdf->SetFont('Arial','',14);
$pdf->Cell(-5,-280,utf8_decode('L\'étiquette Retour vous permet de retourner votre colis '),0,0,'R');
$pdf->Cell(-54,-268,utf8_decode('  sans régler l\'affranchissement.'),0,0,'R');

$pdf->Cell(20,-240,utf8_decode('1. Imprimez votre étiquette RETOUR'),0,0,'R');
$pdf->Cell(-24,-220,utf8_decode('2. Collez-la sur votre colis'),0,0,'R');
$pdf->Cell(36,-200,utf8_decode('3. Deposez votre colis en bureau de poste'),0,0,'R');
$pdf->Image('../img/site/logo2.png',15,10,10); 
$pdf->Output();



?>