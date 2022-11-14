<html>
    <head>
        <title>Profil</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_profil.css">
        <link rel="stylesheet" href="../css/foot_head.css">
    </head>
    <body>

    <?php
    include("head.php");
    include('id.php');

    try {
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $data = $dbh->query("SELECT * FROM alizon._adresse WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
        
   
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>

    <h2  id="titre"> Votre adresse </h2>
    <form method="post" action="page_adresse_sql.php">
        <fieldset>
            <p>
                <?php
            if($dbh->query("SELECT * FROM alizon._adresse  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch()){
                    $data_add = $dbh->query("SELECT * FROM alizon._adresse  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
                    /*echo "<pre>";
        print_r($data_add);
        echo "</pre>";*/
                    echo '<label for="rue">N° Rue :</label>';
                echo '<input type="text" id="rue" name="rue" value = '.$data_add['rue'].' size="30"/>';
                echo '<label for="adresse">Adresse :</label>';
                echo '<input type="text" id="adresse" name="adresse" value = '.$data_add['num'].' size="30" />  ';
                echo '<label for="ville">Ville :</label>';
                echo '<input type="text" id="ville" name="ville" value = '.$data_add['ville'].' size="30" />  ';
                echo '<label for="postal">Code postal :</label>';
                echo '<input type="text" id="postal" name="postal" value = '.$data_add['code_postal'].' size="30" /> ';
                echo '<button type="submit" class="button" id="enr"> Enregistrer </button>';
                }

                else {
                    echo '<label for="rue">N° Rue :</label>';
                    echo '<input type="text" id="rue" name="rue" size="30"  />';
                    echo '<label for="adresse">Adresse :</label>';
                    echo '<input type="text" id="adresse" name="adresse" size="30" />  ';
                    echo '<label for="ville">Ville :</label>';
                    echo '<input type="text" id="ville" name="ville" size="30" />  ';
                    echo '<label for="postal">Code postal :</label>';
                    echo '<input type="text" id="postal" name="postal" size="30" /> ';
                    echo '<button type="submit" class="button" id="enr"> Enregistrer </button>';
                }

                ?>
            </p>
        </fieldset>
    </form>

<?php

?>
</body>
</html>