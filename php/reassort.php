<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/foot_head.css">

    <link rel="stylesheet" href="../bootstrap/js/bootstrap.js"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>

<?php include('./head.php');?>
<?php
    try {
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $produit = $dbh->query("SELECT libelle,quantite_stock FROM Alizon.produit WHERE id_produit =".$_GET['id_produit'], PDO::FETCH_ASSOC) -> fetch();
        echo'<div class="inscription_box text-center container" style="width:80%;height:90%">
        <div class="row justify-content-center mt-2">
            <h3>Réassort de '. $produit["libelle"] .' :</h3>
        </div>
        <div class="row justify-content-center mt-2">
            <div class="col-6">
                <p>Quantité actuel : ' . $produit["quantite_stock"] . '</p>
            </div>
        </div>
            <form id="Formid" action="confirmationCommande.php" method="get" enctype="">
                <div class="row justify-content-center mt-2">
                    <div class="col-4">
                        <label for="fichier">Commandez une quantité :</label>
                        <input name="id_produit" value="'. $_GET["id_produit"] .'" type="hidden">
                        <input name="id_vendeur" value="'. $_SESSION["id_vendeur"] .'" type="hidden">
                        <input type="number" name="qte_commande" id="fichier" class="form-control" min="1" max="999" placeholder="Entre 1 et 999" required>
                        <input type="submit" value="Commander" class="btn btn-primary mt-2">
                    </div>
                </div>
            </form>
        </div>';
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>
<?php include('./footer.php'); ?>