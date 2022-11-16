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
        $data = $dbh->query("SELECT * FROM alizon._client  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
   
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>

    <h2 id="titre"> Votre identité </h2>
    <form method="post" action="page_info_sql.php">
        <fieldset>
            <p>
                <label for="mail">Email :</label>
                <input type="text" id="mail" name="mail" value =<?php echo $data["mail"];?> size="30"/>
                <label for="mail">Mot de passe :</label>
                <input type="text" value =<?php echo '....';?> id="pass" name="pass" size="30" />
                <label for="tel">Numéro de téléphone :</label>
                <input type="text" id="tel" name="tel" value =<?php echo $data["tel"];?> size="30" />  
                <button type="submit" class="button" id="enr"> Enregistrer </button>
            </p>
        </fieldset>
    </form>

<?php

?>
</body>
</html>