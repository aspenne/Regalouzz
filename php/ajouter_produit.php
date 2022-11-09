<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script> 
    <title>Document</title>
</head>
<body>
    <?php
        session_start();

        if (isset($_SESSION["connected"])){
            $id_client = $_SESSION["idclient"];
        }

        echo '<form id="form_panier" action="" method="post">';
            echo '<div id=panier>';
                    echo '<select id="quantite_form" name="value">';
                        echo "<option value='1' selected>1</option>";
                        for ($i=2; $i<10; $i++){
                        echo "<option value='$i'>$i</option>";
                        }
                    echo '</select>';
            echo '</div>';
        echo '</form>';     
        echo '<button id="btn" class="colorbutton" type="submit" onclick="simpleClickPanier(id)" form="form_panier">Ajouter au panier</button>';
        $id_client = 1;
        $id_produit = 8;
        $nb_quantite  = $_POST["value"];             
    ?>
</body>
<footer>
    <script src="../Javascript/add_panier.js"></script>
</footer>
</html>

<?php
include('id.php');
$dbh = new PDO ("$driver:host=$server;port=$port;dbname=$db_name", $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$req = $dbh->prepare("INSERT INTO alizon._panier (id_client, id_produit, quantite) VALUES (:client, :produit, :quantite)");
$req->bindParam(':client', $id_client);
$req->bindParam(':produit', $id_produit);
$req->bindParam(':quantite', $nb_quantite);

$req2 = $dbh->prepare("UPDATE alizon._panier set quantite = quantite + :quantite where id_client = :client");
$req2->bindParam(':client', $id_client);
$req2->bindParam(':quantite', $nb_quantite);

$req3 = $dbh->prepare("SELECT COUNT(*) as res from alizon._panier where id_client = :client and id_produit = :produit");
$req3->bindParam(':client', $id_client);
$req3->bindParam(':produit', $id_produit);

if ( $req3->fetchAll() > 0 ){
    $req2->execute();
}
else{
    try {
        $req->execute();  
    }
    catch (PDOException $e) {
        echo " Erreur !". $e->getMessage();
    }
}

?>