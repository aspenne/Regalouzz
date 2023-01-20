<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_suiviComm.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Document</title>
</head>
<body>
    <?php
    include("head.php");
    ?>
    <main>
        <?php 
        include("id.php");
        $etat = "";
        echo '
        <div class="nav_prof">
            <div class="dropdown">
                <button class="dropbtn">Votre profil 
                    <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="profil#identite">Identité</a>
                    <a href="profil#ad">Adresse</a>
                    <a href="profil#info">Info personnelles </a>
                    <a href="profil#mdp">Mot de passe </a>
                </div>
            </div> 
            <a id="comm"href="#">Vos commandes</a>
        </div>
        <h2> Vos commandes </h2>';
        try
        
        {
            echo "<div id=tablo>";
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id_client = $_SESSION['id_client'];
            $data = $dbh->query("SELECT * FROM alizon._commande WHERE id_client = $id_client", PDO::FETCH_ASSOC);
            $today = date("Y-m-d");
            $iteration = 0;
            echo '<div class=table_box>';
                echo '<table cellpadding ="10">';
                    echo "<tbody>";
                        echo "<tr>";
                            echo "<th> ID </th>";
                            echo "<th> Date </th>";
                            echo "<th> Montant </th>";
                            echo "<th> Etat </th>";
                            echo " <th> Détails </th>";
                            echo "<th> A retourner </th>";
                        echo "</tr>"; 
                        foreach($data as $row){
                            $iteration++;
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
                            $prixTot = $row['prix_total'] + $row['frais_port'];
                            echo "<tr>";
                                echo "<td>" . $row["id_commande"] ."</td>";
                                echo "<td>" .$row['date_commande'] ."</td>";
                                echo "<td>" .$prixTot ." € </td>";
                                echo "<td>" .$etat   ."</td>";
                                echo "<td><button class=\"btn_details\" onclick=\"window.location.href='./details_commande.php?id=".$row['id_commande']."'\">Détails</button></td>";
                                echo "<td><button class=\"btn_details\" onclick=\"window.location.href='demande_retour.php?id_commande=".$row['id_commande']."'\">A retourner</button></td>";
                                echo "</tr>";
                    }
                    echo "</tbody>";
                echo '</table>';
                        
            }

        catch (PDOException $e)
        {       
            print('Erreur : ' . $e->getMessage() . "<br/>");
        }
        
    ?>
    </main>
    <?php
    include("footer.php");
    ?>
</body>
</html>

