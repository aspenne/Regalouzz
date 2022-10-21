<head>
    <title>index</title>
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </head>

<div class="row">
    <div class="col-md-5">Title Test</div>
    <div class="col-md-5">Title Test</div>
    <div class="col-md-5">Title Test</div>
    <div class="col-md-5">Title Test</div>
    <div class="col-md-5">Title Test</div>
    <div class="col-md-5">Title Test</div>
</div>

<?php
include('id.php');
try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    $i=0;
    echo '<div class="row">';
    foreach($dbh->query('SELECT * from Alizon._Produit', PDO::FETCH_ASSOC) as $row) {
        echo "<pre>";
        print_r($row);
        echo "</pre>";
    }
    foreach($dbh->query('SELECT * from Alizon._Produit', PDO::FETCH_ASSOC) as $row) {
        if($i==3){
            echo '</div>';
            echo '<div class="row">';
            echo '<div class="col" style="background-image: url(\'../img/produit/'.$row['id_produit'].'/1.jpg\');"></div>';
            $i=1;
        }
        else{
            echo '<div class="col" style="background-image: url(\'../img/produit/'.$row['id_produit'].'/1.jpg\');">'.$row['libelle'].'</div>';
            $i++;
        }
        
    }
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>