<html>
    <head>
        <title>Demande retour</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!--<link rel="stylesheet" href="../css/style.css">-->
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_retour.css">
        <link rel="stylesheet" href="../css/foot_head.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    </head>
    <?php
    include("head.php");
    include('id.php');
    ?>
<body>
    <main>
        <h2 id="h2_form"> Formulaire de demande de retour </h2>
        
        <!-- Liste deroulante multichoix -->
        <div class="container">
            <div class="row justify-content-center">
                <form id="form_retour" action="demandeRetour_sql.php" method="post">
                    <input name ="idProduitHidden" type="hidden" id="idProduitInput" value="">
                    <input name ="quantiteHidden" type="hidden" id="quantiteInput" value="">
                    <input name ="raisonHidden" type="hidden" id="raisonInput" value="">
                    <input name ="totalHidden" type="hidden" id="totalInput" value="">
            <p id ="prod_ret" for="produit">Produit(s) à retourner :</p>
            <?php

try {
    
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $stmt = $dbh->prepare("SELECT quantite, libelle, id_produit, prix_ttc, id_client FROM alizon.commande  WHERE id_client = ".$_SESSION["id_client"]." and id_commande =".$_GET["id_commande"]);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<ul>";
    $index = 0;
                    foreach ($res as $prod){
                        
                    // echo "<li> <input type='Checkbox' name=".$prod['id_produit']." value='yes'>".$prod['libelle']."<br>";

                        echo '<li><input autocomplete="off" id="checkBox'.$prod["id_produit"].'" name="'.$index.'" type="checkbox" value="'.$prod["prix_ttc"].'" class="checks" onchange="onCheckBoxChange('.$prod["id_produit"].')" /><label>'.$prod['libelle'].' '.$prod['prix_ttc']. ' € <i>unitaire TTC</i></label><br>';   

                        echo '<label> Quantité : </label>
                        <SELECT id="quantite'.$prod["id_produit"].'" size="1" onchange="onQuantiteChange('.$prod["id_produit"].')">';
                        for ($i=1; $i < $prod['quantite']+1; $i++)
                           {
                               echo '<OPTION value='.$i.'>'.$i.'</OPTION>';
                           }
                        echo '</SELECT><br>';
                        //onchange="onRaisonChange('.$prod["id_produit"].')"
                        echo '<label for="raison">Raison du retour :</label>
                            <select name="raison" id="raison'.$prod["id_produit"].'" onchange="onRaisonChange('.$prod["id_produit"].')"> 
                                <option value="Produit défectueux">Produit défectueux</option>
                                <option value="Produit endommagé">Produit endommagé</option>
                                <option value="Produit non conforme">Produit non conforme</option>
                                <option value="Produit non reçu">Produit non reçu</option>
                                <option value="Autre">Autre</option>
                            </select></li><br><br>';
                        $index++;
                    }   
                    echo '</ul>
                    <ul>
                    <li id="selectionne">Au moins un article doit être selectionné</li>
                    </ul>';
                    echo '<input type="hidden" name="id_commande" value="'.$_GET['id_commande'].'"/>';
                    $_SESSION['id_commande'] = $_GET['id_commande'];
                }
                catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                ?>
            </select>

            <br><br>

            <label> Total retourné :</label>
            <p id="demo" name="total"></p>
            <br>
            <input type="button" value="Continuer" id="checkBtn" onclick="validate()">

        </form>
        </div>
        </div>
    </main>

<script src="../Javascript/valRetour.js"></script>

</body>
</html>
