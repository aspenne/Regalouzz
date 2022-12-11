<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/style_suiviComm.css"/>
    <link rel="stylesheet" href="../css/style_prod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
<?php 
    include("id.php");
    include("head.php");
    $etat = "";
    try
    {
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id_vendeur = $_SESSION['id_vendeur'];
            $stmt = $dbh->prepare("SELECT * FROM alizon._ReassortVendeur WHERE id_vendeur = $id_vendeur");
            $stmt->execute();
            $nb = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $today = date("Y-m-d");
            echo '<h2 id="titre_corps"> Historique des réassorts </h2>';
            echo '<main>';
            if(empty($nb)) {
                echo '<p>Vous n\'avez pas de commande enregistré</p>';
            } else {
                $data = $dbh->query("SELECT * FROM alizon._ReassortVendeur NATURAL JOIN Alizon._Produit WHERE id_vendeur = $id_vendeur", PDO::FETCH_ASSOC);
            echo '<div class=table_box>';
                echo '<table cellpadding ="10">';
                    echo "<tbody>";
                        echo "<tr>";
                            echo '<th> NumCommande </th>';
                            echo '<th> Produit </th>';
                            echo '<th> Date </th>';
                            echo '<th> Quantite </th>';
                            echo '<th> Etat </th>';
                            echo '<th> Arrivé? </th>';
                        echo "</tr>"; 
                        foreach($data as $row){
                            /*$iteration++;
                            $date = $row['date_commande'];
                        
                            list($annee1, $mois1, $jour1) = explode('-', $today);
                            list($annee2, $mois2, $jour2) = explode('-', $date);

                            $timestamp1 = mktime(0,0,0,$mois1,$jour1,$annee1);
                            $timestamp2 = mktime(0,0,0,$mois2,$jour2,$annee2);
                            $nbJours = abs($timestamp1 - $timestamp2)/86400;
                            
                            if ($nbJours >= 20){
                                $etat = "Terminée";
                            } else if ($nbJours < 20) {
                                $etat = "En cours";
                            }
                            $prixTot = $row['prix_total'] + $row['frais_port'];*/
                            echo "<tr>";
                                echo "<td>" . $row['id_commande'] ."</td>";
                                echo "<td>" .$row['libelle'] ."</td>";
                                echo "<td>" .$row['date_commande'] ." </td>";
                                echo "<td>" .$row['quantite'] ."</td>";
                                echo "<td>" .$row['etat'] ."</td>";
                                if($row['etat'] != 'livré') {
                                    echo "<td>";
                                    echo "<form id=\"$iter.add\" action=\"modifierStock.php\" method=\"post\">";
                                        echo "<input id=\"$iter" . "add\" name=\"idproduit\" value=\"". $row["id_produit"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter" . "add\" name=\"qte_commande\" value=\"". $row["quantite"] ."\" type=\"hidden\">";
                                        echo "<input id=\"$iter" . "del\" class=\"supp\" type=\"submit\" value=\"Valider\">";
                                    echo "</form>";
                                echo "</td>";
                                } else {
                                echo "<td>";
                                    echo 'X';    
                                echo "</td>";
                                }
                            echo "</tr>";
                    }
                    echo "</tbody>";
                echo '</table>';
            }
            echo '</main>';
        }

    catch (PDOException $e)
    {       
        print('Erreur : ' . $e->getMessage() . "<br/>");
    }
    include("footer.php");
?>
</body>
</html>
