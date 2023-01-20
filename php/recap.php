

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/style_prod.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/recap.css">


    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
<?php
include('id.php');
include('head.php');
?> 
<body>
    <main>

<h2 id="rec">Votre commande a bien été payée et validée<br>Voici votre récapitulatif </h2>
<?php
try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $data_adresse_livraison = $dbh->query("SELECT * from Alizon._adresse natural join alizon._commande  WHERE adresselivr = id_adresse and id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
    $data_adresse_facturation = $dbh->query("SELECT * from Alizon._adresse natural join alizon._commande  WHERE adressefact = id_adresse and id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
    $data_client = $dbh->query("SELECT * FROM alizon._client  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
    if(!isset($_GET['id_commande'])){
    $stmt6 = $dbh->prepare("SELECT id_commande from Alizon.commande  where id_client = ".$_SESSION["id_client"]." order by id_commande DESC FETCH FIRST 1 ROWS ONLY;");
        $stmt6->execute();
        $res_id_commande = $stmt6->fetch(PDO::FETCH_ASSOC);

        $_SESSION["id_commande"] = $res_id_commande["id_commande"];
    }
    else{
        $_SESSION["id_commande"] = $_GET['id_commande'];
    }

    echo "<div class='info'>";
    echo "<h3> Vos coordonnées </h3>";
    echo '<div class="container-fluid">';
    echo '<div class="row">';

    echo '<div class="col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2" >';
    echo "<p> <div class='titr'>Vos informations</div> <br>";
    echo "".$data_client['nom']."<br>";
    echo "".$data_client['prenom']."<br>";
    echo "".$data_client['tel']."<br>";
    echo "".$data_client['mail']."</p>";
    echo '</div>';

    echo '<div class="col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2" >';
    echo "<p> <div class='titr'>Adresse de livraison</div> <br>";
    echo "" .$data_adresse_livraison['num']." ".$data_adresse_livraison['rue']." <br>".$data_adresse_livraison['code_postal']." ".$data_adresse_livraison['ville']."<br> </p>";
    echo '</div>';

    echo '<div class="col-4 col-sm-4 col-md-4 col-lg-2 col-xl-2" >';
    echo "<p> <div class='titr'>Adresse de facturation</div> <br>";
    echo "" .$data_adresse_facturation['num']." ".$data_adresse_facturation['rue']." <br>".$data_adresse_facturation['code_postal']." ".$data_adresse_facturation['ville']."<br> </p>";
    echo "</div>";

    echo "</div>";
    echo "</div>";


    $stmt = $dbh->prepare("SELECT libelle,prix_ttc,quantite_stock,quantite,id_client,id_produit, prix_ht FROM alizon.produit NATURAL JOIN alizon._panier WHERE id_client = ".$_SESSION["id_client"]."");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $total = 0;
    $total_ht = 0;
    echo "<h3 id='ar'> Vos Articles </h3>";
    echo "</div>";
    
    echo "<div class='row' id='lib'>
    <div class='col-1'>
        Nbr
    </div>

    <div class='col-3'>
       Libellé
    </div>

    <div class='col-2'>
        Prix unitaire HT
    </div>

    <div class='col-2'>
        Prix unitaire TTC
    </div>

    <div class='col-2'>
        Prix total TTC
    </div>";
    if(isset($_SESSION['reduction'])){
        echo "<div class='col-2'>
            Réduction
        </div>";
    }
    
echo"</div>

<hr class='sep'>";

    foreach ($res as $prod){

        $total += $prod["prix_ttc"] * $prod["quantite"];
        $total_ht += $prod["prix_ht"] * $prod["quantite"];
        $t = $prod["prix_ttc"] * $prod["quantite"];

        echo "<div class='row' id='art'>
        <div class='col-1'>
            ".$prod["quantite"]."
        </div>

        <div class='col-3'>
            ".$prod["libelle"]."
        </div>

        <div class='col-2'>
            ".$prod["prix_ht"]." €
        </div>

        <div class='col-2'>
            ".$prod["prix_ttc"]." €
        </div>

        <div class='col-2'>
            ".$t." €
        </div>";
        if(isset($_SESSION['reduction'])){
            echo "<div class='col-2'>";
                echo "- ".$_SESSION['reduction']." €";
            echo"</div>";
        }

    echo"</div>
    <hr class='sep'>";
    }


    echo "<div id ='total'>";

    echo "<div class='row' id='art'>
    <div class='col-4'>
        Total commande
    </div>

    <div class='col-3'>
       $total_ht € HT
    </div>

    <div class='col-3'>
        $total € TTC
    </div>";
    if(isset($_SESSION['reduction'])){
        $rest = $total - $_SESSION['reduction'];
        echo "<div class='col-2'>
            Reste a payer : $rest
        </div>";
    }

echo"</div>
</div>";

//bouton facture
echo "<div class='row' id='art'>
<div class='col-4'>
    <a href='facture.php?id=".$_SESSION["id_commande"]."' class='btn btn-primary'>Facture</a>
</div>
</div>";

}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
$dbh->exec("Delete from alizon._panier where id_client = ".$_SESSION['id_client']."");


?>
</div>
</main>
    <?php
    include("./footer.php");
    ?>
</body>
</html>
