<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_panier.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    
    <script src="../bootstrap/js/bootstrap.min.js"></script>
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
                        $prixTotalTTC = 0;
                        $prixTotalHT = 0;
                        $prixTVA = 0;
                        $iter = 0;
                        $iter2 = 0;
                        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                   
                        $stmt = $dbh->prepare("SELECT libelle,prix_ttc,prix_ht,quantite_stock,quantite,id_client,id_produit, taux FROM alizon.produit NATURAL JOIN alizon._panier NATURAL JOIN alizon._taxe NATURAL JOIN alizon._produit WHERE id_client = ".$_SESSION["id_client"]."");
                        $stmt->execute();
                        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if(!$res) {
                            echo'<div style="text-align: center;">';
                                echo '<h2 class=vide> Votre panier est vide </h2>';
                                echo '<p>Vous n\'avez pas d\'article</p>';
                            echo'</div>';
                        } else {
                        echo'<h2><span>Votre</span> panier </h2>';
                        echo "<div class=produits_prix>";
                            echo "<div class=produits>";
                            foreach ($res as $row) {
                            echo "<section>";
                            // Insertion de l'image
                            echo "<div class=section_1part>";
                                echo '<image src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid" onclick="window.location.href=\'./detail_produit.php?ID='.$row['id_produit'].'\';">';
                                // Recupération des données du produit
                                    echo '<article class=detail>';
                                        echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                        echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                    echo "</article>";
                                    echo "<article>";
                                        echo "<p>" . "<span class=prix_ttc>". $row["prix_ttc"] . "€ " . "</span>". "<br>";
                                        echo "<span class=prix_ht>". $row["prix_ht"] . "€ HT" ."</span>" ."</p>";
                                    echo "</article>";
                            echo "</div>";

                                // media queries 480 px
                                echo '<article class=detail2>';
                                    echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                    echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                echo "</article>";

                                echo "<p>" . "<span class=prix_ttc2>". $row["prix_ttc"] . "€ &nbsp" . "</span>";
                                echo "<span class=prix_ht2>". $row["prix_ht"] . "€ HT" ."</span>" ."</p>";
                            
                                // Fonction "Modifier la quantité" 
                                echo "<div class=section_2part>";
                                    echo "<form class=\"form_button\" id=\"$iter.add\" action=\"modifierQuantite.php\" method=\"get\">";
                                        echo "<input id=\"$iter" . "add\" name=\"id_client\" value=\"". $row["id_client"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter" . "add\" name=\"id_produit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                        echo "<input class=\"modif_quantity\" id=\"$iter" . "add\" class=\"valid\" type=\"number\" name=\"quantite\" value=\"" . $row["quantite"] ."\" min=\"1\" max=\"" . $row["quantite_stock"] . "\" required>";
                                        echo "<input class=\"modif_button\" id=\"$iter" . "add\" type=\"submit\" value=\"Modifier la quantité\">";
                                    echo "</form>";
                                
                                // Fonction Supprimer article
                                    echo "<form id=\"$iter2.del\" action=\"supprimer.php\" method=\"get\">";
                                        echo "<input id=\"$iter2" . "del\" name=\"id_client\" value=\"". $row["id_client"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter2" . "del\" name=\"id_produit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                        echo "<input class=\"delete_button\" id=\"$iter2" . "del\"  class=\"supp\" type=\"submit\" value=\"Supprimer\">";
                                    echo "</form>";
                                echo "</div>";
                                echo "</section><br>";
                                
                                // Calcul du prix Total 
                                $prixTotalTTC += $row["quantite"] * $row["prix_ttc"];
                                $prixTotalHT += $row["quantite"] * $row["prix_ht"];
                                $prixTVA = $prixTotalTTC - $prixTotalHT;
                                
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
                        echo'<h1><span>Votre</span> panier : </h1>';
                        echo "<div class=produits_prix>";
                            echo "<div class=produits>";
                        $prixTotalTTC = 0;
                        $prixTotalHT = 0;
                        $prixTVA = 0;
                        $iter = 0;
                        $iter2 = 0;
                        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        foreach ($tab_cookies as $idProd => $quantite) {
                            try {
                                
                                $stmt = $dbh->prepare("SELECT libelle,prix_ttc,prix_ht,quantite_stock,id_produit FROM alizon.produit WHERE id_produit = ". $idProd);
                                $stmt->execute();
                                $row = $stmt->fetch();
                                echo "<section>";
                                    echo "<div class=section_1part>";
                                // Insertion de l'image
                                    echo '<image src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid" onclick="window.location.href=\'./detail_produit.php?ID='.$row['id_produit'].'\';">';
                                    // Recupération des données du produit
                                        echo '<article class=detail>';
                                            echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                            echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                        echo "</article>";
                                        echo "<article>";
                                            echo "<p>" . "<span class=prix_ttc>". $row["prix_ttc"] . "€ " . "</span>". "<br>";
                                            echo "<span class=prix_ht>". $row["prix_ht"] . "€ HT" ."</span>" ."</p>";
                                        echo "</article>";
                                    echo "</div>";

                                    // media queries 480 px
                                    echo '<article class=detail2>';
                                        echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                        echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                    echo "</article>";

                                    echo "<p>" . "<span class=prix_ttc2>". $row["prix_ttc"] . "€ &nbsp" . "</span>";
                                    echo "<span class=prix_ht2>". $row["prix_ht"] . "€ HT" ."</span>" ."</p>";
  
                                    // Fonction "Modifier la quantité" 
                                    echo "<div class=section_2part>";
                                        echo "<form class=\"form_button\" id=\"$iter.add\" action=\"modifierQuantite.php\" method=\"get\">";
                                            echo "<input id=\"$iter" . "add\" name=\"id_produit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                            echo "<input class=\"modif_quantity\" id=\"$iter" . "add\" class=\"valid\" type=\"number\" name=\"quantite\" value=\"" . $tab_cookies[$idProd] ."\" min=\"1\" max=\"" . $row["quantite_stock"] . "\" required>";
                                            echo "<input class=\"modif_button\" id=\"$iter" . "add\" type=\"submit\" value=\"Modifier la quantité\">";
                                        echo "</form>";
                                    
                                    // Fonction Supprimer article
                                        echo "<form id=\"$iter2.del\" action=\"supprimer.php\" method=\"get\">";                                            
                                            echo "<input id=\"$iter2" . "del\" name=\"id_produit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                            echo "<input class=\"delete_button\" id=\"$iter2" . "del\"  class=\"supp\" type=\"submit\" value=\"Supprimer\">";
                                        echo "</form>";
                                    echo "</div>";
                                    echo "</section><br>";
                                
                                // Calcul du prix Total 
                                $prixTotalTTC += $quantite * $row["prix_ttc"];
                                $prixTotalHT += $quantite * $row["prix_ht"];
                                $prixTVA += $prixTotalTTC - $prixTotalHT;
                                
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
                
                <div>
                <hr class="separation" />
                </div>

                <?php
                if($_SESSION["panier"]!=[]) {
                echo "<div class=right_side>";
                    echo "<div class=recap>";
                        echo "<section>";

                        echo "<ul>";
                            echo "<li>Articles : <span class=blue1> $prixTotalHT € </span> HT </li>";
                            echo "<li>TVA : <span class=blue1> $prixTVA € </span></li> ";
                        echo "</ul>";
                        
                        // Fonction "Vider le panier"
                            echo "<form id=\"VidePanier\" action=\"vider_panier.php\" method=\"get\">";
                                echo "<input id=\"btnsupp\" type=\"submit\" value=\"Vider le panier\">";
                            echo "</form>";

                            echo "<div>";
                                echo "<hr class=\"separation\" />";
                            echo "</div>";

                        // Affichage du prix total :
                            echo "<div class=total>";
                                echo "<p>Total : <span class=blue2> $prixTotalTTC € </span> TTC </p>";
                            echo "</div>";

                        // Fonction Passer la commande  
                        echo "</section>";
                    echo "</div>";
                    echo "<form id=\"Commande\" action=\"commande.php\" method=\"get\">";
                        echo "<input id=\"btncomm\" type=\"submit\" value=\"Passer Commande\">";
                    echo "</form>"; 
                echo "</div>";             
            }
            ?>
    </main>
    <?php include("./footer.php"); ?>
</body>
</html>
