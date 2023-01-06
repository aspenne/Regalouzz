<html>
    <head>
        <title>Profil</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_profil.css">
        <link rel="stylesheet" href="../css/foot_head.css">
    </head>

    <?php
    include("head.php");
    if(!isset($_SESSION['admin']) or $_SESSION['admin'] != TRUE){
        header("location:./Liste_produit.php");
    }
    include('id.php');

    try {
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $data = $dbh->query("SELECT * FROM alizon._adresse WHERE id_client='".$_GET["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
        
   
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    <body>
    <main>
    <button type="submit" onclick="window.location.href ='<?php echo 'page_adr_admin.php?id_client='.$_GET['id_client']?>'" class="button" id="btn1">Retour</button>
    <h2 id='titre'> Vos Adresses </h2>
    <form method="post" action="page_adresse_sql_admin.php?id_client=<?php echo $_GET['id_client']?>">
        <div class ='prof'>
        <div class="container">
                <div class="row justify-content-center">
            <p>
                <?php
            if($dbh->query("SELECT * FROM alizon._adresse  WHERE id_client='".$_GET["id_client"]."'", PDO::FETCH_ASSOC)->fetch()){
                    $data_add = $dbh->query("SELECT * FROM alizon._adresse  WHERE id_client='".$_GET["id_client"]."' and id_adresse ='".$_GET['id']."'", PDO::FETCH_ASSOC)->fetch();

                
                echo '<label for="num">Numéro :</label>';
                echo '<input type="text" name="num" value = "'.$data_add['num'].'" size="30" required/>';
                
                echo '<label for="rue">Rue :</label>';
                echo '<input type="text" name="rue" value = "'.$data_add['rue'].'" size="30 required" />  ';
                
                echo '<label for="ville">Ville :</label>';
                echo '<input type="text" name="ville" value = "'.$data_add['ville'].'" size="30" required/>  ';
               
                echo '<label for="postal">Code postal :</label>';
                echo '<input type="text" name="postal" value = "'.$data_add['code_postal'].'" size="30" required /> ';
                
                echo '<label for="postal">Pays :</label>';
               
                echo '<input type="text" name="pays" value = "'.$data_add['pays'].'" size="30" required /> ';

                echo "<input type='hidden' name='id' value='".$data_add['id_adresse']."'/>";

                echo '<button type="submit" class="button" id="enr"> Enregistrer </button>';
                }
                

                ?>
            </p>
            </div>
            </div>
        </div>
    </form>
    <main>
    </body>
<?php

?>
</html>