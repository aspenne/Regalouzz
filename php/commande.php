
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../css/style_commande.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<?php include("head.php");?>
<body>
	<?php
        include('id.php');
        
        if(!isset($_SESSION['id_client'])){
            header('location:./inscription.php');
        }
        $idclient = $_SESSION['id_client'];
	?>
    <main>
        <div>
            <?php
                echo "<div class=container>";
                    echo "<section class=adresses>";
                        echo "<div class=adresses_paiement>";
                            echo "<h2> Adresse de livraison : </h2>";
                            echo "<article class=champs>";
                                    echo "<form id=\"adrLivr\" action=\"\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr\" type=\"text\" name=\"numRue\" value=\"\"></label> ";
                                        echo "<label>Code postal : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"codepost\"></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"adr\"></label> ";
                                    echo "<label>Ville : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"ville\"></label> ";
                                    echo "<label>Pays : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"pays\"></label> ";
                                    echo "<input id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</form>";
                            echo "</article>";
                            echo "</div";

                            echo "<h2> Adresse de facturation : </h2>";
                            echo "<article class=champs>";
                                echo "<form id=\"adrLivr\" action=\"\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr\" type=\"text\" name=\"numRue\" value=\"\"></label> ";
                                        echo "<label>Code postal : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"codepost\"></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"adr\"></label> ";
                                    echo "<label>Ville : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"ville\"></label> ";
                                    echo "<label>Pays : <input id=\"adrLivr\" type=\"text\" value=\"\" name=\"pays\"></label> ";
                                    echo "<input id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</form>";
                            echo "</article>";
                        echo "</div>";
                    echo "</div>";

                        echo "<article class=paiement>";
                            echo "<h2>Mode de paiement : </h2>";
                            echo "<form id=\"modePaiement\" action=\"\" method=\"get\">";
                                echo "<label>Payer par carte bancaire : <input id=\"modePaiement\" type=\"radio\" value=\"carteBanc\" name=\"rbMp\">";
                                echo "</br>";
                                echo "<label>Payer par bon d'achat : <input id=\"modePaiement\" type=\"radio\" value=\"bonAchat\" name=\"rbMp\">";
                                echo "</br>";
                                echo "<input id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                            echo "</form>";
                        echo "</article>";
                        echo "</br>";   
                    echo "</div>";
                    try {
                        $prixTotal = 0;
                        $iter = 0;
                        $iter2 = 0;
                        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                   
                        $stmt = $dbh->prepare("SELECT libelle,prix_ttc,quantite_stock,quantite,id_client,id_produit FROM alizon.produit NATURAL JOIN alizon._panier WHERE id_client = $idclient");
                        $stmt->execute();
                        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if(!$res) {
                            echo "<p>Vous n'avez pas d'article</p>";
                        } else {
                        echo "<div>";
                            echo "<div class=produits_prix>";
                            foreach ($res as $row) {
                                echo "<section>";
                                // Insertion de l'image
                                    echo '<image src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid">';
                                // Recupération des données du produit
                                    echo "<div class=ligne_detail>";
                                        echo "<div class=ligne_detail_1>";
                                        echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                        echo "<p>" . "<span class=orange>" . $row["prix_ttc"] . "€" . "</span>". "<br>". "</p>";
                                        echo "</div>";
                                        echo "<p>" . $row["quantite_stock"] . " produit(s) en stock<br>". "</p>";
                                    echo "</div>";
                                // Calcul du prix Total 

                                $prixTotal += $row["quantite"] * $row["prix_ttc"];
                                
                                array_push($_SESSION["panier"], $row["quantite"]);
                                $iter++;
                                $iter2++;
                                echo "</section>";
                            }
                            echo "</div>";
                            
                        }
                    } catch (PDOException $e) {
                        print "Erreur !: " . $e->getMessage() . "<br>";
                        die();
                    }
                    
                    echo "<div class=recap>";
                    
                    // Fonction "Finaliser commande"
                        echo ' <button id="panier" onclick="finaliserCommande.php">Finaliser la commande et payer</button> ';
                    
                    // Texte
                        echo 'En passant votre commande, vous acceptez les Conditions générales de vente d’Alizon.';
                        // Barre 
                    
                        echo "<ul>";
                            echo "<li>Articles : $prixTotal €</li>";
                        echo "</ul>";
                    // Affichage du prix total :
                        echo "<div class=total>";
                            echo "<p>Total : $prixTotal</p>";
                        echo "</div>";

                    echo "</div>";
                echo "</div>";
            echo "</div>";            
            ?>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>