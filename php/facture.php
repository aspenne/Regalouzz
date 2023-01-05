<?php
session_start();
require('fpdf/fpdf.php');
//require('tfpdf/tfpdf.php');
define('EURO', chr(128));
include('id.php');
  
try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $data_adresse_facturation = $dbh->query("SELECT * from Alizon._adresse natural join alizon._commande  WHERE adressefact = id_adresse and id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
    $data_client = $dbh->query("SELECT * FROM alizon._client  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();

    $stmt = $dbh->prepare("SELECT id_commande, libelle,prix_ttc,quantite_stock,quantite,id_client,id_produit, prix_ht FROM alizon.commande WHERE id_client = ".$_SESSION["id_client"]." and id_commande = ".$_GET["id"]."");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} 

catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "";
    die();
}

class PDF extends FPDF {
    // Page header
    function Header() {
        // Logo
        //$this->Image('../img/site/logo2.png',20,6,15);
        // Arial bold 15
        $this->SetFont('Arial','B',25);
        // Move to the right
        //$this->Cell(80);
        // Title
        $this->Cell(0,15,utf8_decode('Facture'),0,1,'C');
        //date
        $this->SetFont('Arial','B',10);
        $this->Cell(50,5,utf8_decode("Commande n° ". $_GET["id"]),0,1,'L');
        $this->Cell(50,5,utf8_decode("Date de création ".date('d/m/Y')),0,0,'L');
        // Line break
        $this->Ln(20);
    }

    //fonction info entreprise
    function info_entreprise($nom,$adresse,$cp,$ville,$tel,$mail)
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(50,5,utf8_decode($nom),0,1, 'L');
        $this->SetFont('Arial','',12);
        $this->Cell(50,5,utf8_decode($adresse),0,1, 'L');
        $this->Cell(50,5,utf8_decode($cp),0,1, 'L');
        $this->Cell(50,5,utf8_decode($ville),0,1, 'L');
        $this->Cell(50,5,utf8_decode($tel),0,1, 'L');
        $this->Cell(50,5, utf8_decode($mail),0,1, 'L');
        $this->Ln(10);
    }

    //fonction info client
    function info_client($nom,$adresse,$cp,$ville,$tel,$mail)
    {
        $this->SetFont('Arial','B',12);
        $this->Cell(180,5,utf8_decode($nom),0,1,'R');
        $this->SetFont('Arial','',12);
        $this->Cell(180,5,utf8_decode($adresse),0,1,'R');
        $this->Cell(180,5,utf8_decode($cp),0,1, 'R');
        $this->Cell(180,5,utf8_decode($ville),0,1, 'R');
        $this->Cell(180,5,utf8_decode($tel),0,1, 'R');
        $this->Cell(180,5, utf8_decode($mail),0,0, 'R');
        $this->Ln(10);
    }


    function FancyTable($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(255,0,0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128,0,0);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');

    // En-tête
    $w = array(30, 50, 40, 40);
    for($i=0;$i<count($header);$i++)
    $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();

    // Restauration des couleurs et de la police
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    $big_total_ht=0;
    $big_total_tt = 0;
    // Données
    foreach($data as $row)
        {
            $this->Cell(30,6,$row['quantite'],1);
            $this->Cell(50,6,utf8_decode($row['libelle']),1);
            $this->Cell(40,6,$row['prix_ht'],1);
            $total_ht = $row['prix_ht'] * $row['quantite'];
            $this->Cell(40,6,$total_ht,1);

            $big_total_ht += $total_ht;
            $big_total_tt += $row['prix_ttc']* $row['quantite'];
            $this->Ln();

        }
        
        $this->Ln();
        $this->SetFont('Arial','I', 12);
        $this->Cell(80,8,' ','',0,'L',0);
        $this->Cell(40,8,'Total HT', 'R','L',1);
        $this->SetFont('Arial','', 12);
        $this->Cell(40,8,$big_total_ht,1);
        $this->Ln();

        $this->SetFont('Arial','I', 12);
        $this->Cell(80,8,' ','',0,'L',0);
        $this->Cell(40,8,'Taxe', 'R','L',1);  // R = border right, L = align left
        $this->SetFont('Arial','', 12);
        $taxe = $big_total_tt - $big_total_ht;
        $this->Cell(40,8,$taxe,1);
        $this->Ln();

        $this->SetFont('Arial','B', 12);
        $this->Cell(80,8,' ','',0,'L',0);
        $this->Cell(40,8,'TOTAL', 'R','L',1);
        $this->SetFont('Arial','B', 12);
        $this->Cell(40,8,$big_total_tt,1);
        $this->Ln();
    
    // Trait de terminaison
    //$this->Cell(array_sum($w),0,'','T');
    }


    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//Info facture entreprise colonnes 
$pdf->info_entreprise('Alizon','Rue Edouard Branly','22300','Lannion','0102030405','alizon@gmail.com');
//Info facture client colonnes
$pdf->info_client($data_client['nom'].' '.$data_client['prenom'], $data_adresse_facturation['num'].' '. $data_adresse_facturation['rue'] ,$data_adresse_facturation['code_postal'],$data_adresse_facturation['ville'],$data_client['tel'],$data_client['mail']);
$pdf->Ln();
$pdf->Ln();
//Tableau

$header = array('Quantite', 'Libelle', 'Prix Unit. HT  '.EURO, 'Montant HT  '.EURO);
//$data = $pdf->LoadData('facture.txt');
//$pdf->BasicTable($header, $res);
$pdf->FancyTable($header, $res);

$pdf->Output();



?>