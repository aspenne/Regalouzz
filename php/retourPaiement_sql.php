<?php 
session_start();
include('id.php');

try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

function generatePromoCode($length = 10) {
    // Use the current time as the seed for the random number generator
    mt_srand(microtime(true));
  
    // Create an array of characters to use in the promocode
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  
    // Initialize the promocode to an empty string
    $promocode = '';
  
    // Generate a random promocode by selecting a random character from the array
    // and appending it to the promocode string until the desired length is reached
    for ($i = 0; $i < $length; $i++) {
      $promocode .= $characters[mt_rand(0, strlen($characters) - 1)];
    }
  
    // Return the generated promocode
    return $promocode;
  }

$code = generatePromoCode();

foreach($dbh->query('SELECT * from alizon._bontemp', PDO::FETCH_ASSOC) as $row){
    if ($row['code'] == $code) {
      $code = generatePromoCode();
    }
}
$date = date("d-m-Y");
$stmt = $dbh->prepare("INSERT INTO alizon._bontemp (id_bon, id_client, code, valeur, date_bon, heure_bon) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bindValue(1, $_SESSION["id_commande"], PDO::PARAM_INT);
$stmt->bindValue(2, $_SESSION["id_client"], PDO::PARAM_INT);
$stmt->bindValue(3, $code, PDO::PARAM_STR);
$stmt->bindValue(4, $_SESSION["total"], PDO::PARAM_INT);
$stmt->bindValue(5, $date, PDO::PARAM_STR);
$stmt->bindValue(6, $_SESSION['heure'], PDO::PARAM_STR);
$stmt->execute();
header('Location: page_pdf_ret.php');     
?>    