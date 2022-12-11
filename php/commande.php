<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_commande.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<?php 
    include("head.php");
    $codePromo = "abcd";
?>
<body>
	<?php
        include('id.php');
        
        if(!isset($_SESSION['id_client'])){
            header('location:./inscription.php');
        }
        $idclient = $_SESSION['id_client'];
	?>
    <main>
    <?php
    try {

        //recup id adresse livraison
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        $stmt1 = $dbh->prepare("SELECT id_adresse, num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_client = ". $idclient);
        $stmt1->execute();
        $res_adr_fact = $stmt1->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id_adresse_fact'] = $res_adr_fact["id_adresse"];

        //recup id adresse facturation
        $stmt3 = $dbh->prepare("SELECT adresselivr from Alizon._commande natural join Alizon._adresse where id_client = $idclient order by date_commande DESC;");
        $stmt3->execute();
        $res_adr_livr = $stmt3->fetch(PDO::FETCH_ASSOC);

        $_SESSION['id_adresse_livr'] = $res_adr_livr["adresselivr"];
        

        // facturation
        $stmt5 = $dbh->prepare("SELECT num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_client = $idclient FETCH FIRST 1 ROWS ONLY;");
        $stmt5->execute();
        $adresse_fact = $stmt5->fetchAll();

        $res = $adresse_fact;
        

        // livraison
        $stmt2 = $dbh->prepare("SELECT adresselivr from Alizon._commande natural join Alizon._adresse where id_client = $idclient order by date_commande DESC;");
        $stmt2->execute();
        $adresse_livr = $stmt2->fetchColumn();


        if ($adresse_livr != 0) {
        $stmt4 = $dbh->prepare("SELECT num, rue, ville, code_postal, pays FROM alizon._adresse WHERE id_adresse = $adresse_livr;");
        $stmt4->execute();
        $res2 = $stmt4->fetchAll(PDO::FETCH_ASSOC);

        }
        echo'<h1><span>Votre</span> commande : </h1>';

        echo "<div class='container'>";
        
            echo "<div class='container_1'>";

            if(!$res) {
                    echo "<section class = adresses>";
                        echo "<h2> Adresse de livraison </h2>";
                        echo "<article class = champs>";
                        if(isset($_SESSION['numRue'])){
                            echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $_SESSION["numRue"] . "\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_SESSION["codePost"] . "\" name=\"codePost\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_SESSION["adr"] . "\" name=\"adr\"required></label> ";
                                echo "<div class=ligne2>";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $_SESSION["ville"] . "\" name=\"ville\"required></label> ";
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_SESSION["pays"] . "\" name=\"pays\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>"; 
                        }
                        else if($res2){
                        foreach ($res2 as $row2) {
                            echo "<form id=\"adr_livr\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $row2["num"] . "\"></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $row2["code_postal"] . "\" name=\"codePost\"></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $row2["rue"] . "\" name=\"adr\"></label> ";
                                echo "<div class=ligne2>";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $row2["ville"] . "\" name=\"ville\"></label> ";
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $row2["pays"] . "\" name=\"pays\"></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>"; 
                        }
                        }
                        else{
                            echo "<form id=\"adr_livr\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"\"></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"\" name=\"codePost\"></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"\" name=\"adr\"></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"\" name=\"ville\"></label> ";
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"\" name=\"pays\"></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        echo "</article>";

                        echo "<hr class=separation>";

                        echo "<h2> Adresse de facturation </h2>";
                        if(isset($_SESSION['numRue2'])){
                            echo "<article class=champs>";
                            echo "<form id=\"adr_fact\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"". $_SESSION['numRue2'] ."\"></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"". $_SESSION['codePost2'] ."\" name=\"codePost2\"></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"". $_SESSION['adr2'] ."\" name=\"adr2\"></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"". $_SESSION['ville2'] . "\" name=\"ville2\"></label> ";                            
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"". $_SESSION['pays2'] ."\" name=\"pays2\"></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        else{
                            echo "<article class=champs>";
                            echo "<form id=\"adr_fact\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"\"></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"\" name=\"codePost2\"></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"\" name=\"adr2\"></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"\" name=\"ville2\"></label> ";                            
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"\" name=\"pays2\"></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        
                        echo "</article>";
                    echo "</section>";
                    
                    if(isset($_SESSION['numCa'])){
                        echo "<section id=modePaiement class=adresses>";
                            echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                echo "<article class=paiement>"; 
                                    echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">"; 
                                        echo "<div class=ligne1>";
                                            echo "<label>";
                                            echo "<p>Code carte bleu</p>";
                                            echo "<input pattern='[0-9]{16}' id=\"numCa\" type=\"text\" name=\"numCa\" value=\"". $_SESSION['numeCarte'] ."\"> ";
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-1][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"". $_SESSION['mois'] ."\">";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-1][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"". $_SESSION['année'] ."\">";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"". $_SESSION['crypt'] ."\">";
                                        echo "<label>";
                                        echo "<div class = ligne3>";
                                        echo "<label>";
                                            echo "<p class=promo_text > Inserer code promo </p>";
                                            echo "<input id=code_promo type=text name=promo placeholder=E54D21F457>"; 
                                            /*echo "<ul>";
                                                echo "<li class = 'valiCode' id='valiCode'>Code promo invalide</li>";
                                            echo "</ul>";
                                            */
                                        echo "</label>";
                                        echo "<input class=\"valid_btn\" id='valiPay' type='submit' value = '". $_SESSION['totalprix_ttc']." €'>";
                                    echo "</div>";
                                    echo "</form>";
                                echo "</article>";
                        echo "</section>";
                    }
                    else{
                        echo "<section id=modePaiement class=adresses>";
                            echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                echo "<article class=paiement>";
                                    echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">";
                                        echo "<div class=ligne1>";
                                            echo "<label>";
                                            echo "<p>Code carte bleu</p>";
                                            echo "<input pattern='[0-9]{16}' id=\"numCa\" type=\"text\" name=\"numCa\" value=\"\"> ";
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-1][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"\">";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-1][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"\">";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"\">";
                                        echo "<label>";
                                        echo "<div class = ligne3>";
                                        echo "<label>";
                                            echo "<p class=promo_text > Inserer code promo </p>";
                                            echo "<input id=code_promo type=text name=promo placeholder=E54D21F457>"; 
                                            /*echo "<ul>";
                                                echo "<li class = 'valiCode' id='valiCode'>Code promo invalide</li>";
                                            echo "</ul>";
                                            */
                                        echo "</label>";
                                        echo "<input class=\"valid_btn\" id='valiPay' type='submit' value = '". $_SESSION['totalprix_ttc']." €'>";
                                    echo "</div>";
                                    echo "</form>";
                                echo "</article>";
                        echo "</section>";
                    }
                    
            } else {
                    echo "<section class=adresses>";
                        echo "<h2> Adresse de livraison </h2>";
                        echo "<article class=champs>";
                            if(isset($_SESSION['numRue'])){
                                echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $_SESSION["numRue"] . "\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_SESSION["codePost"] . "\" name=\"codePost\"required></label> ";
                                    echo "</div>";

                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_SESSION["adr"] . "\" name=\"adr\"required></label> ";
                                    echo "<div class=ligne2>";
                                    echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $_SESSION["ville"] . "\" name=\"ville\"required></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_SESSION["pays"] . "\" name=\"pays\"required></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";
                                echo "</form>"; 
                            }
                            else if($res2){
                            foreach ($res2 as $row2) {
                                echo "<form id=\"adr_livr\" action=\"\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $row2["num"] . "\"></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $row2["code_postal"] . "\" name=\"codePost\"></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $row2["rue"] . "\" name=\"adr\"></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $row2["ville"] . "\" name=\"ville\"></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $row2["pays"] . "\" name=\"pays\"></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";
                                echo "</form>";
                            }
                            }
                            else{
                                echo "<form id=\"adr_livr\" action=\"\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"\"></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"\" name=\"codePost\"></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"\" name=\"adr\"></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"\" name=\"ville\"></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"\" name=\"pays\"></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";                            
                                echo "</form>";
                            }
                            echo "</article>";

                            echo "<hr class=separation>";

                            if(isset($_SESSION['numRue2'])){
                                echo "<h2> Adresse de facturation </h2>";
                                echo "<article class=champs>";
                                echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"" . $_SESSION["numRue2"] . "\"></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_SESSION["codePost2"] . "\" name=\"codePost2\"></label> ";
                                        echo "ddddd";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_SESSION["adr2"] . "\" name=\"adr2\"></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrFact\" type=\"text\" value=\"" . $_SESSION["ville2"] . "\" name=\"ville2\"></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_SESSION["pays2"] . "\" name=\"pays2\"></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";
                                echo "</form>"; 
                            }
                            else{
                                foreach ($res as $row){
                                    echo "<h2> Adresse de facturation </h2>";
                                    echo "<article class=champs>";
                                        echo "<form id=\"adr_fact\" action=\"\" method=\"get\">";
                                            echo "<div class=ligne1>";
                                                echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"" . $row["num"] . "\"></label> ";
                                                echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"" . $row["code_postal"] . "\" name=\"codePost2\"></label> ";
                                                echo "</div>";
                                            echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $row["rue"] . "\" name=\"adr2\"></label> ";
                                            echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $row["ville"] . "\" name=\"ville2\"></label> ";
                                            echo "<div class=ligne2>";
                                                echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $row["pays"] . "\" name=\"pays2\"></label> ";
                                                echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                            echo "</div>";
                                        echo "</form>";
                            }
                            
                            echo "</article>";
                        }
                        echo "</section>";

                        if(isset($_SESSION['numCa'])){
                            echo "<section id=modePaiement class=adresses>";
                                echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                    echo "<article class=paiement>";
                                        echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">";
                                            echo "<div class=ligne1>";
                                                echo "<label>";
                                                echo "<p>Code carte bleu</p>";
                                                echo "<input pattern='[0-9]{16}' id=\"numCa\" type=\"text\" name=\"numCa\" value=\"". $_SESSION['numeCarte'] ."\"> ";
                                                echo "</label>";
                                            echo "</div>";
                                            echo "<div class = ligne2_2>";
                                            echo "<label>";
                                                echo "<p> Mois </p>";
                                                echo "<input id=\"MM\" pattern='[0-1][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"". $_SESSION['mois'] ."\">";
                                            echo "</label>";
                                            echo "<label>";
                                                echo "<p> Année </p>";
                                                echo "<input id=\"AA\" pattern='[0-1][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"". $_SESSION['année'] ."\">";
                                            echo "</label>";
                                            echo "</div>";
                                            echo "<label>";
                                                echo "<p> Cryptograme </p>";
                                                echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"". $_SESSION['crypt'] ."\">";
                                            echo "<label>";
                                            echo "<div class = ligne3>";
                                            echo "<label>";
                                                echo "<p class=promo_text > Inserer code promo </p>";
                                                echo "<input id=code_promo type=text name=promo placeholder=E54D21F457>"; 
                                                /*echo "<ul>";
                                                echo "<li class = 'valiCode' id='valiCode'>Code promo invalide</li>";
                                            echo "</ul>";
                                            */
                                                
                                                echo "</label>";
                                            echo "<input class=\"valid_btn\" id='valiPay' type='submit' value = '". $_SESSION['totalprix_ttc']." €'>";
                                        echo "</div>";
                                        echo "</form>";
                                    echo "</article>";
                            echo "</section>";
                        }
                        else{
                            echo "<section id=modePaiement class=adresses>";
                            echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                echo "<article class=paiement>";
                                    echo "<form id=\"pay\" action=\"finaliserCommande.php\" method=\"post\">";
                                        echo "<div class=ligne1>";
                                            echo "<label>";
                                            echo "<p>Code carte bleu</p>";
                                            echo "<input pattern='[0-9]{16}' id=\"numCa\" type=\"text\" name=\"numCa\" value=\"\"> ";
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-1][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"\">";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-1][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"\">";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"\">";
                                        echo "<label>";
                                        echo "<div class = ligne3>";
                                        echo "<label>";
                                            echo "<p class=promo_text > Inserer code promo </p>";
                                            echo "<input id=code_promo type=text name=promo placeholder=E54D21F457>"; 
                                            /*echo "<ul>";
                                                echo "<li class = 'valiCode' id='valiCode'>Code promo invalide</li>";
                                            echo "</ul>";
                                            */
                                        echo "</label>";
                                        echo "<input class=\"valid_btn\" id='valiPay' type='submit' value = '". $_SESSION['totalprix_ttc']." €'>";
                                    echo "</div>";
                                    echo "</form>";
                                echo "</article>";
                        echo "</section>";
                        }
                        
            }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br>";
            die();
        }

        $_SESSION['numRue'] = $_GET['numRue'];
        $_SESSION["codePost"] = $_GET['codePost'];
        $_SESSION['adr'] = $_GET['adr'];
        $_SESSION['ville'] = $_GET['ville'];
        $_SESSION['pays'] = $_GET['pays'];

        $_SESSION['numRue2'] = $_GET['numRue2'];
        $_SESSION['codePost2'] = $_GET['codePost2'];
        $_SESSION['adr2'] = $_GET['adr2'];
        $_SESSION['ville2'] = $_GET['ville2'];
        $_SESSION['pays2'] = $_GET['pays2'];

        $_SESSION['numCa'] = $_GET['numeCarte'];
        $_SESSION['MM'] = $_GET['mois'];
        $_SESSION['AA'] = $_GET['année'];
        $_SESSION['crypto'] = $_GET['crypt'];

        if(strcmp($_GET['promo'], '')){
            $_SESSION['promo'] = 0;
        }
        else if(strcmp($_GET['promo'], $codePromo)){
            $_SESSION['promo'] = 1;
            $prixTotalTTC = $prixTotalTTC * 0.80;
        }
        else{
            $_SESSION['promo'] = -1;
        }


        if(isset($_SESSION['numRue'])){
            $_SESSION['verifLivr'] = 1;
        }
        else{
            $_SESSION['verifLivr'] = 0;
        }
        if(isset($_SESSION['numRue2'])){
            $_SESSION['verifFact'] = 1;
        }
        else{
            $_SESSION['verifFact'] = 0;
        }
        if(isset($_SESSION['numCa'])){
            $_SESSION['verifPay'] = 1;
        }
        else{
            $$_SESSION['verifPay'] = 0;
        }
                        try {
                            $prixTotalTTC = 0;
                            $prixTotalHT = 0;
                            $iter = 0;
                            $iter2 = 0;
                            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);                   
                            $stmt3 = $dbh->prepare("SELECT libelle,prix_ttc,prix_ht,quantite_stock,quantite,id_client,id_produit FROM alizon.produit NATURAL JOIN alizon._panier WHERE id_client = $idclient");
                            $stmt3->execute();
                            $res = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                            if(!$res) {
                                echo "<p>Vous n'avez pas d'article</p>";
                            } else {
                                echo "<div class=produits>";
                                foreach ($res as $row) {
                                    echo "<section>";
                                    // Insertion de l'image
                                        echo '<img src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid">';
                                    // Recupération des données du produit
                                        echo "<article>";
                                            echo "<p>" . $row["libelle"] . "<br>" . "</p>";
                                            echo "<p> Quantité : " . $row["quantite"] . "</p>";
                                        echo "</article>";
                                        echo "<article>";
                                            echo "<p>" . $row["prix_ttc"] . "€" . "</span>". "<br>". "</p>";
                                            echo "<p>" . $row["prix_ht"] . "HT </p>";
                                        echo "</article>";
                                    // Calcul du prix Total 

                                    $prixTotalTTC += $row["quantite"] * $row["prix_ttc"];
                                    $prixTotalHT += $row["quantite"] * $row["prix_ht"];
                                    $prixTVA = $prixTotalTTC - $prixTotalHT;
                                    
                                    array_push($_SESSION["panier"], $row["quantite"]);
                                    $iter++;
                                    $iter2++;

                                    echo "</section>";

                                    echo "<hr class=separation>";
                                    
                                }
                                echo "</div>";
                                
                            }

                            echo "</div>";

                            echo "<hr class=separation>";

                            echo "<div class=container_2>";
                        
                            } catch (PDOException $e) {
                                print "Erreur !: " . $e->getMessage() . "<br>";
                                die();
                            }
                        
                                echo "<section class=recap>";

                                // Affichage du prix total
                                echo "<ul>";
                                    echo "<li>Articles : <span class=blue1> $prixTotalHT € </span> HT </li>";
                                    echo "<li>TVA : <span class=blue1> $prixTVA € </span></li> ";
                                echo "</ul>";

                                // Barre 
                                    echo "<hr class=separation>";
                                
                                // Fonction "Finaliser commande"
                                    echo "<div class=button_center>";
                                        echo '<button id = btnVali onclick=finaliserCommande.php form=adr_livr type=submit>Finaliser la commande et payer</button>';
                                    echo "</div>";
                                    echo "<ul>";
                                        echo "<li id='valillivre'>Vous devez remplire le champ Adresse de Livraison</li>";
                                        echo "<li id='valilfact'>Vous devez remplire le champ Adresse de Facturation</li>";
                                        echo "<li id='valilpaye'>Vous devez remplire le champ Payement par carte banquaire</li>";
                                        echo "</br>";
                                    echo "</ul>";

                                // Texte
                                    echo '<p>En passant votre commande, vous acceptez les Conditions générales de vente d’Alizon.</p>';
                                
                                // Barre 
                                    echo "<hr class=separation>";

                                // Affichage du prix total :
                                echo "<div class=total>";
                                    echo "<p>Total : <span class=blue2> $prixTotalTTC € </span> TTC </p>";
                                echo "</div>";

                                echo "</section>"; 
                            echo "</div>";        
                        echo "</div>";                    
        ?>
    </main>
    <?php
    include("./footer.php");
    ?>
    <script>


        var verifLivr = <?php echo(json_encode($_SESSION['verifLivr']));  ?>;
        var verifFact = <?php echo(json_encode($_SESSION['verifFact'])); ?>;
        var verifPay = <?php echo(json_encode($_SESSION['verifPay'])); ?>; 
        var verPromo = <?php echo(json_encode($_SESSION['promo'])); ?>; 


        var tabtn = document.getElementsByClassName("valid_btn");
        //document.getElementById("valiPay").addEventListener('click', validerCode());


        for(let btn of tabtn){
            btn.addEventListener('click', valider());
        }

        document.getElementById("btnVali").disabled = true;
        


        //document.getElementById("valiCode").hidden = true;
        
        function validerLivr(){
            if(verifLivr == 1){
                document.getElementById("valillivre").hidden = true;
            }
            else {
                document.getElementById("valillivre").hidden = false;
            }
        }

        function validerFact(){
            if(verifLivr == 1){
                document.getElementById("valillivre").hidden = true;
            }
            else {
                document.getElementById("valillivre").hidden = false;
            }
        }

        function validerPay(){
            if(verifLivr == 1){
                document.getElementById("valillivre").hidden = true;
            }
            else {
                document.getElementById("valillivre").hidden = false;
            }
        }

        function valider(){

            

            if(verifFact == 1){
                document.getElementById("valilfact").hidden = true;
            }
            

            if(verifPay == 1){
                document.getElementById("valilpaye").hidden = true;
            }
            

            if((verifLivr == 1) && (verifFact == 1) && (verifPay == 1)){
                document.getElementById("btnVali").disabled = false;
            }
            else{
                document.getElementById("btnVali").disabled = true;
            }
        }

        
        /*function validerCode(){
            if(verPromo == 0){
                document.getElementById("valilpay").hidden = true;
            }
            else if(verPromo == 1){
                document.getElementById("valilpay").hidden = true;
            }
            else(verPromo == -1){
                document.getElementById("valilpay").hidden = false;
            }
        }
        */
        
    </script>

</body>
</html>