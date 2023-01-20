<?php
session_start();
require('fpdf/fpdf.php');
//require('tfpdf/tfpdf.php');
define('EURO', chr(128));
include('id.php');
  
try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
<<<<<<< HEAD
    $id_commande = $_SESSION['id_commande'];
=======
    $id_commande = $_GET['id'];
>>>>>>> fc28415794a8bea1ab44f313455ef3a2046f9dc9
    $data_adresse_facturation = $dbh->query("SELECT * from Alizon._adresse natural join alizon._commande  WHERE adressefact = id_adresse and id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
    $data_client = $dbh->query("SELECT * FROM alizon._client  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();

    $stmt = $dbh->prepare("SELECT id_commande, libelle,prix_ttc,quantite_stock,quantite,id_client,id_produit, prix_ht FROM alizon.commande WHERE id_client = ".$_SESSION["id_client"]." and id_commande = ".$id_commande."");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} 

catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "";
    die();
}

?>
<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/inscription_connexion.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
<header>
    <div class="container">
        <div class="row justify-content-center">
            <img src="../img/site/logo.png" style="width:50%;height:auto;cursor:pointer;" onclick="window.location.href='./Liste_produit.php'">
        </div>
    </div>
</header>
<body>
    <div class="inscription_box text-center container" style="width:80%;height:90%">
        <!-- <div class="row justify-content-center">
            <img src="../img/site/logo.png" style="width:50%;height:auto;cursor:pointer;" onclick="window.location.href='./Liste_produit.php'">
        </div> -->
        <div class="row justify-content-center mt-2">
                <h3>Confirmation Commande :</h3>
            </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">


<?php

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
        
        if(isset($_SESSION["reduction"])){
            $this->Ln();
            $this->SetFont('Arial','I', 12);
            $this->Cell(80,8,' ','',0,'L',0);
            $this->Cell(40,8,'Bon de reduction', 'R','L',1);
            $this->SetFont('Arial','', 12);
            $this->Cell(40,8,$_SESSION["reduction"],1);
            $this->Ln();}

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

<<<<<<< HEAD
=======
$pdf->Output("mon_pdf.pdf", "F");
>>>>>>> fc28415794a8bea1ab44f313455ef3a2046f9dc9


// Confirmation par mail
    // Contenu du mail : 
    // Récupérez le contenu du PDF

<<<<<<< HEAD
$pdf->Output("mon_pdf.pdf", "F");


// Confirmation par mail
    // Contenu du mail : 
    // Récupérez le contenu du PDF

=======
>>>>>>> fc28415794a8bea1ab44f313455ef3a2046f9dc9
     //-----------------------------------------------
     //DECLARE LES VARIABLES
     //-----------------------------------------------
 
     $from = 'cobrec.alizon@gmail.com';
     $nom = 'Confirmation Commande - Alizon';
     $sujet ='Votre Facture Alizon';
     $sujet = html_entity_decode($sujet);
     #$sujet = $sujet;
    
     #include($root.'include/fpdf16/mod6.php');
  
  
      //-----------------------------------------------
      //GENERE LA FRONTIERE DU MAIL ENTRE TEXTE ET HTML
      //-----------------------------------------------
  
     $eol = PHP_EOL;
     $limite = md5(uniqid(microtime(), TRUE));
     #$limite = "----------=_parties_".md5(uniqid (rand()));
  
  
      //-----------------------------------------------
      //HEADERS DU MAIL
      //-----------------------------------------------
  
     $header  = 'Reply-to: '.$from.$eol;
     $header .= 'From: '.$from.$eol;

     $header .= 'Return-Path: '.$from.$eol;
     #$header .= 'X-Confirm-Reading-To: '.$from.$eol;
    $header .= 'X-Sender: '.$eol;
     $header .= 'X-Mailer: PHP/5.3.2'.$eol;
     $header .= 'X-auth-smtp-user: '.$from.$eol;
     $header .= 'X-abuse-contact: '.$from.$eol;
     $header .= 'X-Spam-Status: No'.$eol;
     $header .= 'Date: '.date('D, j M Y G:i:s O').$eol;
     $header .= 'MIME-Version: 1.0'.$eol;
     $header .= 'Content-Type: multipart/mixed; boundary='.$limite.$eol;
     #$header .= 'Content-Type: multipart/alternative; boundary="'.$limite.'"'."\r\n";
  
  
      //-----------------------------------------------
      //MESSAGE TEXTE
      //-----------------------------------------------
  
     #$message_ = "";
  
     $message_ = '--'.$limite.$eol;
     
     
       $message_ .= 'Texte affiché par des clients mail ne supportant pas le type MIME.'.$eol.$eol;
     
  
      //-----------------------------------------------
      //MESSAGE HTML
      //-----------------------------------------------
  
     $message_ .= '--'.$limite.$eol;
     $message_ .= 'Content-type: text/html; charset=utf-8'.$eol.$eol;

  
  
  
    //------
    // PIECE JOINTE
    //-------------
        $filename = 'mon_pdf.pdf';
     if (file_exists($filename)){
         #$file_type = filetype($filename);
         #$file_size = filesize($filename);
  
         $message_ .= '--'.$limite.$eol;
         $message_ .= 'Content-Type: application/pdf; name="message.pdf"'.$eol;
         #$message_ .= 'Content-Type: application/octet-stream; name="uuu'.$filename.'"'.$eol;
         $message_ .= 'Content-Transfer-Encoding: base64'.$eol;
         $message_ .= 'Content-Disposition: attachment'.$eol.$eol; 
         $message_ .= chunk_split(base64_encode(file_get_contents($filename))).$eol.$eol;
  
  
     }else{echo 'existe pas';}
  
  
  
     $message_ .= '--'.$limite.'--'.$eol;
  
      //-----------------------------------------------
      //ENVOI
      //-----------------------------------------------
    $recup = $dbh->prepare("SELECT mail FROM alizon._client WHERE id_client = ?");
    $recup->execute([$_SESSION['id_client']]);
    $resRecup = $recup->fetch(PDO::FETCH_ASSOC);
    foreach($resRecup as $row){
    if(mail($row, $sujet, $message_, $header)){
        echo 'Un mail de confirmation de votre commande avec votre facture en pièce jointe a été envoyé.';
    } 
    else {
        echo 'Une erreur est survenue';
    }
}
  
  
?>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['error'])){
                                echo '<div class="row justify-content-center mt-3">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                            <label style="color : red">Erreur :</label>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                            <label style="color : red">Identifiants incorrects</label>
                                        </div>
                                    </div>';
                            }
                        ?>
                        <div class="row justify-content-center mt-3">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <?php
                                    echo "<button type='button' onclick='location.href=\"facture_ligne.php?id=".$id_commande."\"'>Consulter Facture</button>";
                                ?>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <?php
                                    echo "<button type='button' onclick='location.href=\"recap.php?id=".$id_commande."\"'>Retour sur Alizon</button>";
                                ?>
                            </div>
                        </div>
        </div>
    </body>
    <footer>

    </footer>
