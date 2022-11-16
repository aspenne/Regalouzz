
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_panier.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php
    include("head.php");
    include("id.php");
    $_SESSION["panier"] = [];
    ?>
    <main>
            <?php
                if(isset($_SESSION["id_client"])){
                    try {
                        $prixTotal = 0;
                        $iter = 0;
                        $iter2 = 0;
                        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                   
                        $stmt = $dbh->prepare("SELECT libelle,prix_ttc,quantite_stock,quantite,id_client,id_produit FROM alizon.produit NATURAL JOIN alizon._panier WHERE id_client = ".$_SESSION["id_client"]."");
                        $stmt->execute();
                        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if(!$res) {
                            echo'<div style="text-align: center;">';
                            echo '<h1> Votre panier : </h1>
                            <p>Vous n\'avez pas d\'article</p>';
                            echo'</div>';
                        } else {
                        echo'<h1> Votre panier : </h1>';
                        echo "<div class=produits_prix>";
                            echo "<div class=produits>";
                            foreach ($res as $row) {
                            echo "<section>";
                            // Insertion de l'image
                                echo '<image src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid" onclick="window.location.href=\'./detail_produit.php?ID='.$row['id_produit'].'\';">';
                                // Recupération des données du produit
                                    echo '<article style="cursor:pointer" onclick="window.location.href=\'./detail_produit.php?ID='.$row['id_produit'].'\';">';
                                    // onclick=\"window.location.replace(\'./detail_produit.php?ID='.$row['id_produit'].'\');\"
                                    echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                    echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                    echo "</article>";
                            
                                
                                // Fonction "Modifier la quantité" 
                                    echo "<form id=\"$iter.add\" action=\"modifierQuantite.php\" method=\"get\">";
                                        echo "<input id=\"$iter" . "add\" name=\"idclient\" value=\"". $row["id_client"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter" . "add\" name=\"idproduit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter" . "add\" class=\"valid\" type=\"number\" name=\"quantite\" value=\"" . $row["quantite"] ."\" min=\"1\" max=\"" . $row["quantite_stock"] . "\" required>";
                                        echo "<input id=\"$iter" . "add\" type=\"submit\" value=\"Modifier la quantité\">";
                                    echo "</form>";
                                
                                // Fonction Supprimer article
                                    echo "<form id=\"$iter2.del\" action=\"supprimer.php\" method=\"get\">";
                                        echo "<p>" . "<span class=orange>". "Le prix : " . $row["prix_ttc"] . "€" . "</span>". "<br>". "</p>";
                                        echo "<input id=\"$iter2" . "del\" name=\"idclient\" value=\"". $row["id_client"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter2" . "del\" name=\"idproduit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter2" . "del\"  class=\"supp\" type=\"submit\" value=\"Supprimer\">";
                                    echo "</form>";
                                echo "</section><br>";
                                
                                // Calcul du prix Total 
                                $prixTotal += $row["quantite"] * $row["prix_ttc"];
                                
                                array_push($_SESSION["panier"], $row["quantite"]);
                                $iter++;
                                $iter2++;
                            }
                            echo "</div>";
                        }
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br>";
                        die();
                    }
                }
                else{
                    if(isset($_COOKIE["panier"]) and $_COOKIE["panier"] != ""){
                        $tab_cookies = unserialize($_COOKIE['panier']);
                        echo "<div class=produits_prix>";
                        echo "<div class=produits>";
                        $prixTotal = 0;
                        $iter = 0;
                        $iter2 = 0;
                        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        foreach ($tab_cookies as $idProd => $quantite) {
                            try {
                                
                                //PB Panier quand supression dernier article
                                                  
                                $stmt = $dbh->prepare("SELECT libelle,prix_ttc,quantite_stock,id_produit FROM alizon.produit WHERE id_produit = ". $idProd);
                                $stmt->execute();
                                $row = $stmt->fetch();
                                echo "<section>";
                                // Insertion de l'image
                                    echo '<image src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid" onclick="window.location.href=\'./detail_produit.php?ID='.$row['id_produit'].'\';">';
                                    // Recupération des données du produit
                                        echo '<article style="cursor:pointer" onclick="window.location.href=\'./detail_produit.php?ID='.$row['id_produit'].'\';">';
                                        // onclick=\"window.location.replace(\'./detail_produit.php?ID='.$row['id_produit'].'\');\"
                                        echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                        echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                        echo "</article>";
                                
                                    
                                    // Fonction "Modifier la quantité" 
                                        echo "<form id=\"$iter.add\" action=\"modifierQuantite.php\" method=\"get\">";
                                            echo "<input id=\"$iter" . "add\" name=\"idproduit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                            echo "<input id=\"$iter" . "add\" class=\"valid\" type=\"number\" name=\"quantite\" value=\"" . $tab_cookies[$idProd] ."\" min=\"1\" max=\"" . $row["quantite_stock"] . "\" required>";
                                            echo "<input id=\"$iter" . "add\" type=\"submit\" value=\"Modifier la quantité\">";
                                        echo "</form>";
                                    
                                    // Fonction Supprimer article
                                        echo "<form id=\"$iter2.del\" action=\"supprimer.php\" method=\"get\">";
                                            echo "<p>" . "<span class=orange>". "Le prix : " . $row["prix_ttc"] . "€" . "</span>". "<br>". "</p>";
                                            echo "<input id=\"$iter2" . "del\" name=\"idproduit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                            echo "<input id=\"$iter2" . "del\"  class=\"supp\" type=\"submit\" value=\"Supprimer\">";
                                        echo "</form>";
                                    echo "</section><br>";
                                
                                // Calcul du prix Total 
                                $prixTotal += $quantite * $row["prix_ttc"];
                                
                                array_push($_SESSION["panier"], $quantite);
                                $iter++;
                                $iter2++;                    
                                
                            } catch (PDOException $e) {
                                print "Erreur !: " . $e->getMessage() . "<br>";
                                die();
                            }
                        }
                        echo "</div>";
                    }
                    else{
                        echo'<div style="text-align: center;">';
                        echo '<h1> Votre panier : </h1>
                        <p>Vous n\'avez pas d\'article</p>';
                        echo'</div>';
                    }
                }
            ?>
                
                <div class="bar"></div>

                <?php
                if($_SESSION["panier"]!=[]) {
                    echo "<div class=recap>";
                    // Affichage du prix total :
                        echo "<div class=total>";
                            echo "<p>Total : <span class=orange> $prixTotal </span></p>";
                        echo "</div>";

                        // Fonction "Passer commande"
                            echo "<form id=\"Commande\" action=\"commande.php\" method=\"get\">";
                                echo "<input id=\"btn" . "comm\" type=\"submit\" value=\"Passer la Commande\">";
                            echo "</form>"; 
                        
                        // Fonction "Vider le panier"
                            echo "<form id=\"VidePanier\" action=\"vider_panier.php\" method=\"get\">";
                                echo "<input id=\"btn" . "supp\" type=\"submit\" value=\"Vider le panier\">";
                            echo "</form>";
                    echo "</div>";
                echo "</div>";
            }
            ?>
    </main>
    <?php include("./footer.php"); ?>
</body>
</html>