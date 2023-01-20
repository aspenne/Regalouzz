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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_commande.css">
    <title>Document</title>
</head>
<?php 
    include("head.php");
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
        if(!($res_adr_fact == false)){
            $_SESSION['id_adresse_fact'] = $res_adr_fact["id_adresse"];
        }
        //recup id adresse facturation
        $stmt3 = $dbh->prepare("SELECT adresselivr from Alizon._commande natural join Alizon._adresse where id_client = $idclient order by date_commande DESC;");
        $stmt3->execute();
        $res_adr_livr = $stmt3->fetch(PDO::FETCH_ASSOC);
        if(!($res_adr_livr == false)){
            $_SESSION['id_adresse_livr'] = $res_adr_livr["adresselivr"];
        }
        


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
        echo'<h1> Votre commande : </h1>';
        echo "<div class='container'>";
        
            echo "<div class='container_1'>";

            if(!$res) {
                    echo "<section class = adresses>";
                        echo "<h2> Adresse de livraison </h2>";
                        echo "<article class = champs>";
                        if(isset($_GET['numRue'])){
                            echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $_GET["numRue"] . "\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_GET["codePost"] . "\" name=\"codePost\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_GET["adr"] . "\" name=\"adr\"required></label> ";
                                echo "<div class=ligne2>";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $_GET["ville"] . "\" name=\"ville\"required></label> ";
                                echo "</div>";
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_GET["pays"] . "\" name=\"pays\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>"; 

                        }
                        else if(isset($_SESSION['numRue'])){
                            echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $_SESSION["numRue"] . "\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_SESSION["codePost"] . "\" name=\"codePost\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_SESSION["adr"] . "\" name=\"adr\"required></label> ";
                                echo "<div class=ligne2>";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $_SESSION["ville"] . "\" name=\"ville\"required></label> ";
                                echo "</div>";
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
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $row2["num"] . "\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $row2["code_postal"] . "\" name=\"codePost\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $row2["rue"] . "\" name=\"adr\"required></label> ";
                                echo "<div class=ligne2>";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $row2["ville"] . "\" name=\"ville\"required></label> ";
                                echo "</div>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $row2["pays"] . "\" name=\"pays\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>"; 

                        }
                        }
                        else{
                            echo "<form id=\"adr_livr\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"\" name=\"codePost\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"\" name=\"adr\"required></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"\" name=\"ville\"required></label> ";
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"\" name=\"pays\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        echo "</article>";

                        echo "<hr class=separation>";

                        echo "<h2> Adresse de facturation </h2>";
                        if(isset($_GET['numRue2'])){
                            echo "<article class=champs>";
                            echo "<form id=\"adr_fact\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"". $_GET['numRue2'] ."\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"". $_GET['codePost2'] ."\" name=\"codePost2\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"". $_GET['adr2'] ."\" name=\"adr2\"required></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"". $_GET['ville2'] . "\" name=\"ville2\"required></label> ";                            
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"". $_GET['pays2'] ."\" name=\"pays2\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        else if(isset($_SESSION['numRue2'])){
                            echo "<article class=champs>";
                            echo "<form id=\"adr_fact\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"". $_SESSION['numRue2'] ."\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"". $_SESSION['codePost2'] ."\" name=\"codePost2\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"". $_SESSION['adr2'] ."\" name=\"adr2\"required></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"". $_SESSION['ville2'] . "\" name=\"ville2\"required></label> ";                            
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"". $_SESSION['pays2'] ."\" name=\"pays2\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        else{
                            echo "<article class=champs>";
                            echo "<form id=\"adr_fact\" action=\"\" method=\"get\">";
                                echo "<div class=ligne1>";
                                    echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"\"required></label> ";
                                    echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"\" name=\"codePost2\"required></label> ";
                                echo "</div>";
                                echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"\" name=\"adr2\"required></label> ";
                                echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"\" name=\"ville2\"required></label> ";                            
                                echo "<div class=ligne2>";
                                    echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"\" name=\"pays2\"required></label> ";
                                    echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                echo "</div>";
                            echo "</form>";
                        }
                        
                        echo "</article>";
                    echo "</section>";
                    
                    if(isset($_POST['numCa'])){
                        echo "<section id=modePaiement class=adresses>";
                            echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                echo "<article class=paiement>"; 
                                    echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">"; 
                                        echo "<div class=ligne1>";
                                            echo "<label>";
                                            echo "<p>Code carte bleu</p>";
                                            echo "<input pattern='[0-9]{16}'  class = 'numCa' id=\"numCa\" type=\"text\" name=\"numCa\"  value=\"". $_POST['numCa'] ."\"required> ";
                                            echo "<ul>";
                                                echo "<li id = 'tailleCrypto'>Erreur : Donnez un numéro de carte de 16 chiffres</li>";
                                                echo "<li id = 'valiCarte'>Erreur : donnez un numéro de carte valide </li>";
                                            echo "</ul>";
                                            
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-9][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"". $_POST['MM'] ."\"required>";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-9][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"". $_POST['AA'] ."\"required>";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<div class=ligne2>";
                                                echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"". $_POST['crypto'] ."\"required>";
                                                echo "<input class=\"valid_btn\" id='btnvaliCode' type='submit' value = 'Valider'>";
                                            echo "</div>";    
                                        echo "</label>";
                                        echo "</form>";
                                echo "</article>";
                        echo "</section>";
                    }
                    else if(isset($_SESSION['numCa'])){
                        echo "<section id=modePaiement class=adresses>";
                            echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                echo "<article class=paiement>"; 
                                    echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">"; 
                                        echo "<div class=ligne1>";
                                            echo "<label>";
                                            echo "<p>Code carte bleu</p>";
                                            echo "<input pattern='[0-9]{16}'  class = 'numCa' id=\"numCa\" type=\"text\" name=\"numCa\"  value=\"". $_SESSION['numCa'] ."\"required> ";
                                            echo "<ul>";
                                                echo "<li id = 'tailleCrypto'>Erreur : Donnez un numéro de carte de 16 chiffres</li>";
                                                echo "<li id = 'valiCarte'>Erreur : donnez un numéro de carte valide </li>";
                                            echo "</ul>";
                                            
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-9][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"". $_SESSION['MM'] ."\"required>";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-9][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"". $_SESSION['AA'] ."\"required>";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<div class=ligne2>";
                                                echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"". $_SESSION['crypto'] ."\"required>";
                                                echo "<input class=\"valid_btn\" id='btnvaliCode' type='submit' value = 'Valider'>";
                                            echo "</div>";    
                                        echo "</label>";
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
                                            echo "<input pattern='[0-9]{16}' class = 'numCa' id=\"numCa\" type=\"text\" name=\"numCa\" value=\"\"required> ";
                                            echo "<ul>";
                                                echo "<li id = 'tailleCrypto'>Erreur : Donnez un numéro de carte de 16 chiffres</li>";
                                                echo "<li id = 'valiCarte'>Erreur : donnez un numéro de carte valide </li>";
                                            echo "</ul>";
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-9][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"\"required>";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-9][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"\"required>";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<div class=ligne2>";
                                                echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"\"required>";
                                                echo "<input class=\"valid_btn\" id='btnvaliCode' type='submit' value = 'Valider'>";
                                            echo "</div>";
                                        echo "</label>";
                                        echo "</form>";
                                echo "</article>";
                        echo "</section>";
                    }
                    
            } else {
                    echo "<section class=adresses>";
                        echo "<h2> Adresse de livraison </h2>";
                        echo "<article class=champs>";
                            if(isset($_GET['numRue'])){
                                echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $_GET["numRue"] . "\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_GET["codePost"] . "\" name=\"codePost\"required></label> ";
                                    echo "</div>";

                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_GET["adr"] . "\" name=\"adr\"required></label> ";
                                    echo "<div class=ligne2>";
                                    echo "</div>";
                                    echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $_GET["ville"] . "\" name=\"ville\"required></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_GET["pays"] . "\" name=\"pays\"required></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";
                                echo "</form>"; 
                            }
                            else if(isset($_SESSION['numRue'])){
                                echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $_SESSION["numRue"] . "\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_SESSION["codePost"] . "\" name=\"codePost\"required></label> ";
                                    echo "</div>";

                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_SESSION["adr"] . "\" name=\"adr\"required></label> ";
                                    echo "<div class=ligne2>";
                                    echo "</div>";
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
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"" . $row2["num"] . "\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $row2["code_postal"] . "\" name=\"codePost\"required></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $row2["rue"] . "\" name=\"adr\"required></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $row2["ville"] . "\" name=\"ville\"required></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $row2["pays"] . "\" name=\"pays\"required></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";
                                echo "</form>";
                                 
                            }
                            }
                            else{
                                echo "<form id=\"adr_livr\" action=\"\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue\" value=\"\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"\" name=\"codePost\"required></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"\" name=\"adr\"required></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"\" name=\"ville\"required></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"\" name=\"pays\"required></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";                            
                                echo "</form>";

                            }
                            echo "</article>";

                            echo "<hr class=separation>";

                            if(isset($_GET['numRue2'])){
                                echo "<h2> Adresse de facturation </h2>";
                                echo "<article class=champs>";
                                echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"" . $_GET["numRue2"] . "\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_GET["codePost2"] . "\" name=\"codePost2\"required></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_GET["adr2"] . "\" name=\"adr2\"required></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrFact\" type=\"text\" value=\"" . $_GET["ville2"] . "\" name=\"ville2\"required></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_GET["pays2"] . "\" name=\"pays2\"required></label> ";
                                        echo "<input class=\"valid_btn\" id=\"adrFact\" type=\"submit\" value=\"Valider\"\">";
                                    echo "</div>";
                                echo "</form>"; 
                                 
                            }
                            else if(isset($_SESSION['numRue2'])){
                                echo "<h2> Adresse de facturation </h2>";
                                echo "<article class=champs>";
                                echo "<form id=\"adr_livr\" action=\"commande.php\" method=\"get\">";
                                    echo "<div class=ligne1>";
                                        echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"" . $_SESSION["numRue2"] . "\"required></label> ";
                                        echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"\" value=\"" . $_SESSION["codePost2"] . "\" name=\"codePost2\"required></label> ";
                                    echo "</div>";
                                    echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $_SESSION["adr2"] . "\" name=\"adr2\"required></label> ";
                                    echo "<label>Ville&nbsp; : <input id=\"adrFact\" type=\"text\" value=\"" . $_SESSION["ville2"] . "\" name=\"ville2\"required></label> ";
                                    echo "<div class=ligne2>";
                                        echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $_SESSION["pays2"] . "\" name=\"pays2\"required></label> ";
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
                                                echo "<label>Numéro de rue : <input id=\"adrLivr_ndr\" type=\"text\" name=\"numRue2\" value=\"" . $row["num"] . "\"required></label> ";
                                                echo "<label class=cdp >Code postal :  <input id=\"adrLivr_cdp\" type=\"text\" value=\"" . $row["code_postal"] . "\" name=\"codePost2\"required></label> ";
                                                echo "</div>";
                                            echo "<label>Adresse (Rue, Avenue, etc.) : <input id=\"adrLivr_rae\" type=\"text\" value=\"" . $row["rue"] . "\" name=\"adr2\"required></label> ";
                                            echo "<label>Ville&nbsp; : <input id=\"adrLivr_v\" type=\"text\" value=\"" . $row["ville"] . "\" name=\"ville2\"required></label> ";
                                            echo "<div class=ligne2>";
                                                echo "<label>Pays : <input id=\"adrLivr_p\" type=\"text\" value=\"" . $row["pays"] . "\" name=\"pays2\"required></label> ";
                                                echo "<input class=\"valid_btn\" id=\"adrLivr\" type=\"submit\" value=\"Valider\"\">";
                                            echo "</div>";
                                        echo "</form>";
                                         
                            }
                            
                            echo "</article>";
                        }
                        echo "</section>";

                        if(isset($_POST['numCa'])){
                            echo "<section id=modePaiement class=adresses>";
                                echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                    echo "<article class=paiement>";
                                        echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">";
                                            echo "<div class=ligne1>";
                                                echo "<label>";
                                                echo "<p>Code carte bleu</p>";
                                                echo "<input pattern='[0-9]{16}' class = 'numCa' id=\"numCa\" type=\"text\" name=\"numCa\"  value=\"". $_POST['numCa'] ."\"required> ";
                                                echo "<ul>";
                                                    echo "<li id = 'tailleCrypto'>Erreur : Donnez un numéro de carte de 16 chiffres</li>";
                                                    echo "<li id = 'valiCarte'>Erreur : donnez un numéro de carte valide </li>";
                                                echo "</ul>";
                                                echo "</label>";
                                            echo "</div>";
                                            echo "<div class = ligne2_2>";
                                            echo "<label>";
                                                echo "<p> Mois </p>";
                                                echo "<input id=\"MM\" pattern='[0-9][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"". $_POST['MM'] ."\"required>";
                                            echo "</label>";
                                            echo "<label>";
                                                echo "<p> Année </p>";
                                                echo "<input id=\"AA\" pattern='[0-9][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"". $_POST['AA'] ."\"required>";
                                            echo "</label>";
                                            echo "</div>";
                                            echo "<label>";
                                                echo "<div class=ligne2>";
                                                    echo "<p> Cryptograme </p>";
                                                    echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"". $_POST['crypto'] ."\"required>";
                                                echo "</div>";
                                            echo "<label>";
                                            echo "<div class = ligne3>";
                                                echo "<label>";
                                                echo "<input class=\"valid_btn\" id='btnvaliCode' type='submit' value = 'Valider'>";
                                            echo "</div>";
                                        echo "</form>";
                                    echo "</article>";
                            echo "</section>";
                             
                        }
                        else if(isset($_SESSION['numCa'])){
                            echo "<section id=modePaiement class=adresses>";
                                echo'<h2><span>Paiement</span> par carte bancaire </h2>';
                                    echo "<article class=paiement>";
                                        echo "<form id=\"pay\" action=\"commande.php\" method=\"post\">";
                                            echo "<div class=ligne1>";
                                                echo "<label>";
                                                echo "<p>Code carte bleu</p>";
                                                echo "<input pattern='[0-9]{16}' class = 'numCa' id=\"numCa\" type=\"text\" name=\"numCa\"  value=\"". $_SESSION['numCa'] ."\"required> ";
                                                echo "<ul>";
                                                    echo "<li id = 'tailleCrypto'>Erreur : Donnez un numéro de carte de 16 chiffres</li>";
                                                    echo "<li id = 'valiCarte'>Erreur : donnez un numéro de carte valide </li>";
                                                echo "</ul>";
                                                echo "</label>";
                                            echo "</div>";
                                            echo "<div class = ligne2_2>";
                                            echo "<label>";
                                                echo "<p> Mois </p>";
                                                echo "<input id=\"MM\" pattern='[0-9][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"". $_SESSION['MM'] ."\"required>";
                                            echo "</label>";
                                            echo "<label>";
                                                echo "<p> Année </p>";
                                                echo "<input id=\"AA\" pattern='[0-9][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"". $_SESSION['AA'] ."\"required>";
                                            echo "</label>";
                                            echo "</div>";
                                            echo "<label>";
                                                echo "<div class=ligne2>";
                                                    echo "<p> Cryptograme </p>";
                                                    echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"". $_SESSION['crypto'] ."\"required>";
                                                echo "</div>";
                                            echo "<label>";
                                            echo "<div class = ligne3>";
                                                echo "<label>";
                                                echo "<input class=\"valid_btn\" id='btnvaliCode' type='submit' value = 'Valider'>";
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
                                            echo "<input pattern='[0-9]{16}' class = 'numCa' id=\"numCa\" type=\"text\" name=\"numCa\" value=\"\"required> ";
                                            echo "<ul>";
                                                echo "<li id = 'tailleCrypto'>Erreur : Donnez un numéro de carte de 16 chiffres</li>";
                                                echo "<li id = 'valiCarte'>Erreur : donnez un numéro de carte valide </li>";
                                            echo "</ul>";
                                            echo "</label>";
                                        echo "</div>";
                                        echo "<div class = ligne2_2>";
                                        echo "<label>";
                                            echo "<p> Mois </p>";
                                            echo "<input id=\"MM\" pattern='[0-9][0-9]' placeholder='MM' type=\"text\" name=\"MM\" value=\"\"required>";
                                        echo "</label>";
                                        echo "<label>";
                                            echo "<p> Année </p>";
                                            echo "<input id=\"AA\" pattern='[0-9][0-9]' placeholder='AA' type=\"text\" name=\"AA\" value=\"\"required>";
                                        echo "</label>";
                                        echo "</div>";
                                        echo "<div class=ligne2>";
                                        echo "<label>";
                                            echo "<p> Cryptograme </p>";
                                            echo "<input id=\"crypto\" pattern='[0-9]{3}' placeholder='101' type=\"text\" name=\"crypto\" value=\"\"required>";
                                        echo "<label>";
                                        echo "</div>";
                                        echo "<input class=\"valid_btn\" id='btnvaliCode' type='submit' value = 'Valider'>";
                                    echo "</form>";
                                echo "</article>";
                        echo "</section>";
                         
                    }
            }
            // Posibilité d'entrer le code de retour
            

            if(isset($_POST['promo'])){ 
                echo "<section id=modePaiement class=adresses>";
                    echo'<h1><span>Réduction appliqué de '. $_SESSION['reduction'] . ' €</h1></br>';
                echo "</section>";
            }
            else{
                echo "<section id=modePaiement class=adresses>";
                echo'<h2><span>Inserer</span> code de retour</h2>';
                    echo "<article>";
                        echo "<form id=\"code\" action=\"commande.php\" method=\"post\">";
                            echo "<label>";
                                echo "<div class = ligne3>";
                                echo "<input id=code_promo type=text name=promo placeholder=E54D21F457>"; 
                                echo "<ul>";
                                    echo "<li class = 'valiCode' id='errCode' hidden>Code promo invalide</li>";
                                    
                                echo "</ul>";
                            echo "</label>";
                            echo "<input class=\"valid_btn\" id='btnvaliProm' type='submit' value = 'Valider' disabeled>";
                            echo "</div>";
                        echo "</form>";
                    echo "</article>";
                echo "</section>";
            }
            

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br>";
            die();
        } 

        // Verification Code de promo
        $valiCode = -1;


        

        if(isset($_GET['numRue'])){
            $_SESSION['numRue'] = $_GET['numRue'];
            $_SESSION["codePost"] = $_GET['codePost'];
            $_SESSION['adr'] = $_GET['adr'];
            $_SESSION['ville'] = $_GET['ville'];
            $_SESSION['pays'] = $_GET['pays'];
        }



        if(isset($_GET['numRue2'])){
            $_SESSION['numRue2'] = $_GET['numRue2'];
            $_SESSION['codePost2'] = $_GET['codePost2'];
            $_SESSION['adr2'] = $_GET['adr2'];
            $_SESSION['ville2'] = $_GET['ville2'];
            $_SESSION['pays2'] = $_GET['pays2'];
            

        }


        if(isset($_POST['numCa'])){
            $_SESSION['numCa'] = $_POST['numCa'];
            $_SESSION['MM'] = $_POST['MM'];
            $_SESSION['AA'] = $_POST['AA'];
            $_SESSION['crypto'] = $_POST['crypto'];
        }

        if(isset($_POST['cgvcgu'])){
            if($_POST['cgvcgu'] == 'ok'){
                $_SESSION['cgvcgu'] = 1;
            }
            else{
                $_SESSION['cgvcgu'] = 0;
            }
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
            $_SESSION['verifPay'] = 0;
            
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
                                
                            } 
                            else {
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
                                    $_SESSION['prixtot'] = $prixTotalTTC;
                                    
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
                                        echo '<button type="button" id="btnVali" onClick="javascript:document.location.href=\'Commande_sql.php\'" >Finaliser la commande et payer</button>';
                                        echo "</div>";
                                    echo "<ul>";
                                        echo "<li id='valillivre'>Vous devez remplire le champ Adresse de Livraison</li>";
                                        echo "<li id='valilfact'>Vous devez remplire le champ Adresse de Facturation</li>";
                                        echo "<li id='valilpaye'>Vous devez remplire le champ Payement par carte banquaire</li>";
                                        echo "</br>";
                                    echo "</ul>";

                                // Texte
                                if(isset($_POST['cgvcgu'])){
                                    echo "<form id=\"cgv_cgu\" action=\"commande.php\" method=\"post\">";
                                    echo '<input type="checkbox" name = "cgvcgu" cgvcguid="cgvcgu" value = 1 checked ><label>En passant votre commande, vous acceptez les Conditions générales de vente d’Alizon.</label>';
                                    echo "<input class=\"valid_btn\" id='btnvaliCguCgv' type='submit' value = 'Valider'>";
                                    echo '</form>';
                                }
                                else{
                                    echo "<form id=\"cgv_cgu\" action=\"commande.php\" method=\"post\">";
                                    echo '<input type="checkbox" name = "cgvcgu"id="cgvcgu" value = 1  ><label>En passant votre commande, vous acceptez les Conditions générales de vente d’Alizon.</label>';
                                    echo "<input class=\"valid_btn\" id='btnvaliCguCgv' type='submit' value = 'Valider'>";
                                    echo '</form>';
                                }
                                    // Barre                             $stmt3 = $dbh->prepare("SELECT libelle,prix_ttc,prix_ht,quantite_stock,quantite,id_client,id_produit FROM alizon.produit NATURAL JOIN alizon._panier WHERE id_client = $idclient");

                                    echo "<hr class=separation>";

                                // Affichage du prix total :
                                echo "<div class=total>";
                                    if((isset($_SESSION['reduction'])) && ($_SESSION['reduction'] != 0)){
                                        $nouv = $prixTotalTTC - $_SESSION['reduction'];
                                        echo "<p>Total : <span class=blue2>". $nouv." € </span> TTC </p>";
                                    }
                                    else{
                                        echo "<p>Total : <span class=blue2> $prixTotalTTC € </span> TTC </p>";
                                    }
                                    
                                echo "</div>";

                                echo "</section>";
                            echo "</div>";
                        echo "</div>";
                        $_SESSION['total'] = $prixTotalTTC;


                        if(isset($_POST['promo'])){             //Permet la gestion des bons
                            $tempCode = $_POST['promo'];
                            $_SESSION["Code"] = $tempCode;      //Récupération de la variable code pour l'update de la table bon
                            $stmt4 = $dbh->prepare("SELECT valeur FROM alizon._bon WHERE id_client = $idclient AND code = '$tempCode' AND valeur != 0 FETCH FIRST 1 ROWS ONLY;"); // récupération du bon entrée dans le formulaire appartenant au client
                            $stmt4->execute();
                            $valPromo = $stmt4->fetchAll();
                            
                            if(count($valPromo) == 1){  // s'il y en a un code de promo valide
                                echo "code promo valide";
                                foreach($valPromo as $ligne){     // On récupre la valeur  
                                    if($_SESSION['prixtot'] < $ligne['valeur']){
                                        $temp1 = $ligne['valeur'] - $_SESSION['prixtot'];
                                        $_SESSION['reduction'] = $ligne['valeur'] - $temp1;  //$_SESSION['reduction'] correspond a la valeur réduite au prix
                                        $_SESSION['reducTot'] = $ligne['valeur'];              //Permet de récupérer la valeur total de la promo (dans la bdd) pour la mettre a jours dans la page commande_sql.php
                                    }
                                    else{
                                        $_SESSION['prixtot'] = $_SESSION['prixtot'] - $ligne['valeur'];
                                        $_SESSION['reduction'] = $ligne['valeur'];
                                    }
                                    
                                    $valiCode = 1;      //valicode est égale a 1 si c'est le bon code
                                }
                            }
                            else{
                                $valiCode = 0; //valicode est égale a 0 si ce n'est pas le bon code
                            }
                        }
                        else{
                            $valiCode = -1;      //vali code est égale a -1 pour n'afficher rien
                        }

        ?>
    </main>
    <?php
    include("./footer.php");
    ?>
    
    <script>
//                                  ------------"OK"

        var verifLivr = <?php echo(json_encode($_SESSION['verifLivr']));?>; //Récupération des variables de session php pour les utiliser dans la validation
        var verifFact = <?php echo(json_encode($_SESSION['verifFact']));?>;
        var verifPay = <?php echo(json_encode($_SESSION['verifPay']));?>;
        //var verifCguCgv = 
        var verPromo = <?php echo(json_encode($valiCode))?>;



        var tabtn = document.getElementsByClassName("valid_btn");
        //document.getElementById("valiPay").addEventListener('click', validerCode());


        for(let btn of tabtn){
            btn.addEventListener('click', valider());
        }
        document.getElementById("btnvaliCguCgv").addEventListener("click", valider());
        document.getElementById("valiCode").hidden = true;
        document.getElementById("errCode").hidden = true;
        document.getElementById("btnvaliCode").disabled = true;
        document.getElementById("btnvaliProm").disabled = true;
        document.getElementById("valiCarte").hidden = true;
        document.getElementById("tailleCrypto").hidden = true;


        //document.getElementById("valiCode").hidden = true;
        

        function valider(){ 
            if(verifLivr == 1){
                document.getElementById("valillivre").hidden = true;
            }

            if(verifFact == 1){
                document.getElementById("valilfact").hidden = true;
            }
            
            if(verifPay == 1){
                document.getElementById("valilpaye").hidden = true;
            }
            

            if((verifLivr == 1) && (verifFact == 1) && (verifPay == 1) && (verifCguCgv == 1)){
                document.getElementById("btnVali").disabled = false;
            }
            else{
                document.getElementById("btnVali").disabled = true;
            }

        }

        function validerTailleCode(){
            entrée = document.getElementById("code_promo");
            tabl = entrée.value.split('');
            if(tabl.length != 10){
                document.getElementById("errCode").hidden = false;
                document.getElementById("btnvaliProm").disabled = true;
            }
            else{
                document.getElementById("btnvaliProm").disabled = false;
                document.getElementById("errCode").hidden = true;
                
            }
        }    


        
        if(verPromo == 0){
            document.getElementById("valiCode").hidden = true;
            document.getElementById("errCode").hidden = false;

        }
        else if(verPromo == 1){
            document.getElementById("valiCode").hidden = false;
            document.getElementById("errCode").hidden = true;

        }
        else{
            document.getElementById("valiCode").hidden = true;
            document.getElementById("errCode").hidden = true;
        }
        

    
   //                                  -------------Validation de la carte bleu-------------------
    </script>


    <script src="../Javascript/ValidationPay.js"></script>

</body>
</html>
