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

        if (isset($_SESSION["id_client"])){
            $id_client = $_SESSION["id_client"];
        

            /* echo '<form id="form_panier" action="" method="post">';
                echo '<div id=panier>';
                        echo '<select id="quantite_form" name="value">';
                            echo "<option value='1' selected>1</option>";
                            for ($i=2; $i<10; $i++){
                            echo "<option value='$i'>$i</option>";
                            }
                        echo '</select>';
                echo '</div>';
                echo '</form>';     
            *///echo '<button id="btn" class="colorbutton" type="submit" onclick="simpleClickPanier(id)" form="form_panier">Ajouter au panier</button>';
            $id_produit = $_POST["id_produit"];
            $nb_quantite  = $_POST["quantite"];
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // ajoute au panier du client le produit numéro "x"
            $req = $dbh->prepare("INSERT INTO alizon._panier (id_client, id_produit, quantite) VALUES (:client, :produit, :quantite)");
            $req->bindParam(':client', $id_client);
            $req->bindParam(':produit', $id_produit);
            $req->bindParam(':quantite', $nb_quantite);

            // ajoute la quantite "y" pour un client à un produit  numéro "x" au panier d'un client
            $req2 = $dbh->prepare("UPDATE alizon._panier set quantite = quantite + :quantite where id_client = :client and id_produit = :produit");
            $req2->bindParam(':client', $id_client);
            $req2->bindParam(':quantite', $nb_quantite);
            $req2->bindParam(':produit', $id_produit);

            // si il y a déjà un client qui possède cette article dans le panier alors on fait la req2 donc un update sinon req donc un insert
            if ($dbh->query("SELECT * from alizon._panier where id_client = ".$id_client." and id_produit = ".$id_produit."",PDO::FETCH_ASSOC)->fetch()){
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

        }else{
            if(isset($_COOKIE["panier"])){
                $panier = unserialize($_COOKIE["panier"]);
                $id_produit = $_POST["id_produit"];
                $nb_quantite  = $_POST["quantite"];
                if(array_key_exists($id_produit, $panier)){
                    $panier[$id_produit] += $nb_quantite;
                }else{
                    $panier[$id_produit] = $nb_quantite;
                }
                setcookie("panier", serialize($panier), time() + 3600*24*30);
            }else{
                $panier = array();
                $id_produit = $_POST["id_produit"];
                $nb_quantite  = $_POST["quantite"];
                $panier[$id_produit] = $nb_quantite;
                setcookie("panier", serialize($panier), time() + 3600*24*30);
            }
        }

        // if an article is on the favorite list and we want to add it to the cart, we delete it from the favorite list
        if(isset($_SESSION['id_client'])) {
            if ($dbh->query("SELECT * from alizon._ListeDeSouhait where id_client=".$id_client." and id_produit=".$id_produit,PDO::FETCH_ASSOC)->fetch()){
                $req3 = $dbh->prepare("DELETE FROM alizon._listedesouhait where id_client = :client and id_produit = :produit");
                $req3->bindParam(':client', $id_client);
                $req3->bindParam(':produit', $id_produit);
                $req3->execute();
            }
        }

        ?>
</body>
<footer>
    <?php echo'<script>window.location.replace("./detail_produit.php?ID='.$id_produit.'&Panier=True");</script>';?>
</footer>
</html>
