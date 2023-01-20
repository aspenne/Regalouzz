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
$date = date("d-m-Y");
$_SESSION['total'] = $_POST['totalHidden'];
$dbh->exec("INSERT INTO alizon._bonTemp (ID_Bon, iD_Client, code, valeur, date_bon) VALUES (".$_SESSION['id_commande'].",".$_SESSION["id_client"].",".generatePromoCode().",".$_SESSION['total']."," . $date . ""); 
//header('Location: retourPaiement.php');
        

?>    