<html>
    <head>
        <title>Adresse</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_profil.css">
        <link rel="stylesheet" href="../css/foot_head.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <?php
    include("head.php");
    include('id.php');
    ?>
<body>
    <main>
    <?php
try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    $stmt = $dbh->prepare("SELECT * FROM alizon._adresse WHERE id_client = ".$_SESSION["id_client"]."");
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo '<h2 id="titre"> Vos Adresses </h2>';
    echo '<button type="submit" onclick="window.location.href = \'page_adr_add.php\'" class="button" id="btn">Ajouter une adresse</button>';
    echo '<div class="container">';
    echo '<div class="row justify-content-center">';
    $cpt = 0;
    
    foreach ($res as $adr){
        $cpt +=1;
        echo "<div class='adresse'>
            <p> Adresse n° ".$cpt." </p>
            <p> Rue : ".$adr['num']. " ". $adr['rue']."</p>
            <p> Code Postal : ".$adr['code_postal']."</p>
            <p> Ville : ".$adr['ville']."</p>
            <p> Pays : ".$adr['pays']."</p>
            <button type='submit' onclick='window.location.href = \"page_adresse.php?id=".$adr['id_adresse']."\"' class='button' id='mod'>Modifier</button>
        </div>";
        
    }
    echo '</div>
    </div>
    <button type="submit" onclick="window.location.href = \'profil.php\'" class="button" id="btn2">Retour profil</button>';

}
catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

?> 
</main>
</body>
<?php
include('footer.php');
?>
</html>