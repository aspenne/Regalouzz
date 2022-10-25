<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <header>
        <div>
            <button id="panier" >
                Panier
                <i class="fa-solid fa-cart-shopping"></i>
            </button>
        </div>
    </header>
    <main>
        <div>
            <h1> Votre panier : </h1>
            <?php
                include('connect_params.php');
            
                try {
                    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                    foreach($dbh->query('SELECT libelle, descr, prix_ttc, prix_ht, quantite_stock, id_produit, quantite from Alizon.Produit NATURAL JOIN Alizon._Panier WHERE id_client = 1', PDO::FETCH_ASSOC) as $row) {
                        // Récupération des informations du produit dans la BDD
                        echo "<article>" .$row['libelle'] ." - " .$row['descr'] ."</br>"  ;
                        echo $row['prix_ht'] ." € </br>";
                        echo "Il reste " .$row['quantite_stock'] ." en stock. </br>";

                        // Récupération de l'image
                        echo '<image src="./img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid">';

                        // Modifier la quantité
                        $max = $row['quantite_stock'];
                        $qte = $row['quantite'];
                        echo $qte;
                        echo "<form action = \"panier.php\" method=\"post\" >";
                            echo "<input id=\"modifQ\" type=\"number\" name=\"valQ\" value=\"$qte\" min=\"1\" max=\"$max\"/>";
                            echo "<input id=\"validQ\" type=\"submit\" value=\"Valider quantité\"";    
                        echo "</form>";    

                        // Bouton supprimer 
                        echo ' <button id="panier" onclick="">Supprimer <i class="fa-solid fa-trash-can"></i></button> ';
                        echo " </article> </br> ";
                        // Autre
                        $total = $row['prix_ttc'] + $total;
                        
                }   
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                foreach($tabVal as $val){
                    echo $val;
                }
                echo $total;
            ?>
        </div>
        <div>
            <button></button>
        </div>
    </main>
    <footer>

    </footer>
</body>
</html>