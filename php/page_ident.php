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
        /*echo "<pre>";
        print_r($data);
        echo "</pre>";*/
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>

    <h2  id="titre"> Votre identité </h2>
    <form method="post" action="page_ident_sql.php">
    <fieldset>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value =<?php echo $data["prenom"];?> size="30" />
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value =<?php echo $data["nom"];?> size="30" />  
            <label for="age">Age :</label>
            <input type="text" id="date_naissance" name="date" value =<?php echo $data["date_naissance"];?> size="30" />  
            <button type="submit" class="button" id="enr"> Enregistrer </button>
        </p>
        </fieldset>
    </form>

<?php


?>
</body>
</html>
