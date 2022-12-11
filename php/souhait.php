<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_souhait.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php
    include("head.php");
    include("id.php");
    ?>
    <main>
            <?php
                try {
                    $prixTotalTTC = 0;
                    $prixTotalHT = 0;
                    $prixTVA = 0;
                    $iter = 0;
                    $iter2 = 0;
                    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 

                    // récupère le produit dans la liste des souhait du client et ensui avec des join on récupère les infos du produits comme le stock ou le prix               
                    $stmt = $dbh->prepare("SELECT libelle,prix_ttc,prix_ht,quantite_stock,id_client,id_produit FROM alizon.produit NATURAL JOIN alizon._listedesouhait NATURAL JOIN alizon._taxe NATURAL JOIN alizon._produit WHERE id_client = ".$_SESSION["id_client"]."");
                    $stmt->execute();
                    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if(!$res) {
                        echo'<div style="text-align: center;">';
                            echo '<h2 class=vide> Votre Liste de souhait est vide </h2>';
                            echo '<p>Vous n\'avez pas d\'article dans votre liste de souhait</p>';
                        echo'</div>';
                    } else {
                    echo'<h2>Votre liste de souhait : </h2>';
                    echo "<div class=produits_prix>";
                        echo "<div class=produits>";
                        // pour chaque article de la liste des souhaits
                        foreach ($res as $row) {
                        echo "<section>";
                        // Insertion de l'image
                        echo "<div class='section_1part'>";
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

                        // Fonction "Ajouter au panier" 
                        echo "<div class=section_2part>";
                        echo "<form class=\"form_button\" id=\"$iter.add\" action=\"ajouter_produit.php\" method=\"post\">";
                            echo "<input id=\"$iter" . "add\" name=\"id_client\" value=\"". $row["id_client"] ."\" type=\"hidden\">";
                            echo "<input id=\"$iter" . "add\" name=\"id_produit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                            echo "<input id=\"quantite\" name=\"quantite\" min=\"1\ max=\"1\" value=\"1\" type=\"hidden\">";
                            echo "<input class=\"add_panier_button\" id=\"$iter" . "add\" type=\"submit\" value=\"Ajouter au panier\">";
                        echo "</form>";    

                        // Fonction Supprimer article
                        echo "<div class=section_2part>";
                        echo "<form id=\"$iter2.del\" action=\"supprimer_souhait.php\" method=\"get\">";
                            echo "<input id=\"$iter2" . "del\" name=\"id_client\" value=\"". $row["id_client"] ."\" type=\"hidden\">";
                            echo "<input id=\"$iter2" . "del\" name=\"id_produit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                            echo "<input class=\"delete_button\" id=\"$iter2" . "del\"  class=\"supp\" type=\"submit\" value=\"Supprimer\">";
                        echo "</form>";
                        echo "</div>";

                        
                        echo '</section>';
                        }
                        echo '</div>';
                    echo "</div>";
                    }
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br>";
                    die();
                }    
            ?>
    </main>
    <?php include("./footer.php"); ?>
</body>
</html>
