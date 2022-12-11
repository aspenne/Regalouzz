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
        include('id.php');
        
            $id_client = $_SESSION["id_client"];
            $id_produit = $_POST["id_produit"];
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // ajoute a la liste de souhait du client le produit numéro "x"
            $req4 = $dbh->prepare("INSERT INTO alizon._listedesouhait (id_client, id_produit) VALUES (:client, :produit)");
            $req4->bindParam(':client', $id_client);
            $req4->bindParam(':produit', $id_produit);

            // dans la liste de souhait il n'y a pas de notion de quantite donc on effectue l'insert seulement si le produit n'est pas déjà dans la liste de souhait du client
            if (!($dbh->query("SELECT * from alizon._listedesouhait where id_client = ".$id_client." and id_produit = ".$id_produit."",PDO::FETCH_ASSOC)->fetch())){
                try {
                    $req4->execute();  
                }
                catch (PDOException $e) {
                    echo " Erreur !". $e->getMessage();
                }
            }
    ?>
</body>
<footer>
    <?php echo'<script>window.location.replace("./detail_produit.php?ID='.$id_produit.'&Panier=True");</script>';?>
</footer>
</html>
