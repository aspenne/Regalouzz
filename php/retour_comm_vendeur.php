<<<<<<< HEAD
<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_retour_vend.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/foot_head.css">

    <link rel="stylesheet" href="../bootstrap/js/bootstrap.js"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<?php include('./head.php');?>
    <main>
        <?php 
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style_retour_vend.css">
    <link rel="stylesheet" href="../css/style_profil.css">

    <script src="../Bootstrap/js/bootstrap.min.js"></script> 
    <title>Document</title>
</head>
<body>
<?php
    //include("head.php");
    ?>
    <main>
        <?php 
        include("id.php");
        //include ("head.php");
        //if (isset($_SESSION["id_client"])){
            //$id_client = $_SESSION["id_client"];

>>>>>>> fc28415794a8bea1ab44f313455ef3a2046f9dc9
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            $stmt = $dbh->prepare("SELECT * FROM alizon._retour natural join alizon._produit natural join alizon._client order by heure");
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
<<<<<<< HEAD
            

            // store the current client_id
            $current_client_id = null;
            $current_commande_id = null;
            $current_date = null;

            // iterate through the clients and their commandes
            

            if(!$res) {
                echo'<div style="text-align: center;">';
                echo '<h1> Vos retours : </h1>
                <p>Vous n\'avez pas de retours en attente</p>';
                echo'</div>';
            }

            else{
            echo "<h2 id='h2_ar'>Articles retournés</h2>";
            //echo "<ul>";
            $i=0;
            foreach($res as $client_commande){
                // check if the client id is different from the current
                if ($client_commande['id_client'] != $current_client_id || $client_commande['id_commande'] != $current_commande_id || $client_commande['date_ret'] != $current_date || $client_commande['heure'] != $current_heure) {
                    $i++;
                    // if it is, display the client name
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                    echo "</form>";
                    echo "<div id='prof'>";
                    echo "<div class='container'>";
                    echo "<div class='row justify-content-center'>";
                    echo  "<form id='form_retour' action='confirm_ret_sql.php' method='post'>";
                    echo '<button id="validate-button">Valider retour</button><br>';

                    echo '<input name ="idClientHidden" type="hidden" id="idClientInput" value="'.$client_commande['id_client'].'">';
                    echo '<input name ="idCommandeHidden" type="hidden" id="idCommandeInput" value="'.$client_commande['id_commande'].'">';
                    echo '<input name ="dateHidden" type="hidden" id="dateInput" value="'.$client_commande['date_ret'].'">';
                    echo '<input name ="heureHidden" type="hidden" id="heureInput" value="'.$client_commande['heure'].'">';

                    echo '<p><b> Client : ' . $client_commande['prenom'].' ' . $client_commande['nom']. '<br>
                    Id commande : ' . $client_commande['id_commande'].'<br>
                    Date retour : '. $client_commande['date_ret'] .
                    '</b></p>';
                    // and store the new client_id
                    $current_client_id = $client_commande['id_client'];
                    $current_commande_id = $client_commande['id_commande'];
                    $current_date = $client_commande['date_ret'];
                    $current_heure = $client_commande['heure'];
                }

                // display the commande information
                echo '<p> ' . $client_commande['libelle'] . '<br> Quantité ' . $client_commande['quantite'] . '<br> Raison : '. $client_commande['raison'] .'</p>';
                    }
                }
        

?>
    </main>
</body>
<?php
    include("footer.php");
    ?>
=======


    // store the current client_id
    $current_client_id = null;
    $current_commande_id = null;
    $current_date = null;

    // iterate through the clients and their commandes
    

    if(!$res) {
        echo'<div style="text-align: center;">';
        echo '<h1> Vos retours : </h1>
        <p>Vous n\'avez pas de retours en attente</p>';
        echo'</div>';
    }
    else{
    echo "<h2 id='h2_ar'>Articles retournés</h2>";
    //echo "<ul>";
    $i=0;
    foreach($res as $client_commande){
        // check if the client id is different from the current
        if ($client_commande['id_client'] != $current_client_id || $client_commande['id_commande'] != $current_commande_id || $client_commande['date_ret'] != $current_date || $client_commande['heure'] != $current_heure) {
            $i++;
            // if it is, display the client name
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</form>";
            echo "<div id='prof'>";
            echo "<div class='container'>";
            echo "<div class='row justify-content-center'>";
            echo  "<form id='form_retour' action='confirm_ret_sql.php' method='post'>";
            echo '<button id="validate-button" onclick="confirmation()">Valider retour</button><br>';

            echo '<input name ="idClientHidden" type="hidden" id="idClientInput" value="'.$client_commande['id_client'].'">';
            echo '<input name ="idCommandeHidden" type="hidden" id="idCommandeInput" value="'.$client_commande['id_commande'].'">';
            echo '<input name ="dateHidden" type="hidden" id="dateInput" value="'.$client_commande['date_ret'].'">';
            echo '<input name ="heureHidden" type="hidden" id="heureInput" value="'.$client_commande['heure'].'">';

            echo '<p><b> Client : ' . $client_commande['prenom'].' ' . $client_commande['nom']. '<br>
            Id commande : ' . $client_commande['id_commande'].'<br>
            Date retour : '. $client_commande['date_ret'] .
            '</b></p>';
            // and store the new client_id
            $current_client_id = $client_commande['id_client'];
            $current_commande_id = $client_commande['id_commande'];
            $current_date = $client_commande['date_ret'];
            $current_heure = $client_commande['heure'];
        }

        // display the commande information
        echo '<p> ' . $client_commande['libelle'] . '<br> Quantité ' . $client_commande['quantite'] . '<br> Raison : '. $client_commande['raison'] .'</p>';
        
    }
}
    //echo "</ul>";

?>
        <script src="../Javascript/retour_comm_vendeur.js"></script>
    </main>
</body>
>>>>>>> fc28415794a8bea1ab44f313455ef3a2046f9dc9
</html>


    
