
<html>
    <head>
        <title>Profil</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_profil.css">
        <link rel="stylesheet" href="../css/foot_head.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <div id="nav_prof">
        <ul>
            <li><a href="#"> Votre profil </a>
            <ul>
                <li><a href="#identite"> Identité </a></li>
                <li><a href="#ad"> Adresse </a></li>
                <li><a href="#info"> Info personnelles </a></li>
                <li><a href="#"> Paiement </a></li>
                <li><a href="#"> Liste de souhait </a></li>
            </ul>
            </li>

            <li><a href="#">  Paramètres </a></li>
            <li><a href="#">  Données personnelles </a></li>
            <li><a href="#">  Signalements </a></li>
        </ul>
    </div>

    <fieldset>
        <legend id ="identite">Votre identité</legend>
        <p>
            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" value =<?php echo $data["prenom"];?> size="30" disabled="disabled"/>
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value =<?php echo $data["nom"];?> size="30" disabled="disabled"/>  
            <label for="age">Age :</label>
            <input type="text" id="age" name="age" value =<?php echo $data["date_naissance"];?> size="30" disabled="disabled"/>  
            <button type="submit" onclick="window.location.href = 'page_ident.php'" class="button" id="edit"  > Editer</button> 
        </p>
    </fieldset>

    <fieldset>
        <legend id ="ad">Adresse</legend>
        <p> 
            <?php
                if($dbh->query("SELECT * FROM alizon._adresse  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch()){
                    $data_add = $dbh->query("SELECT * FROM alizon._adresse  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
                    /*echo "<pre>";
        print_r($data_add);
        echo "</pre>";*/
                    echo '<label for="rue">N° Rue :</label>';
                echo '<input type="text" id="rue" name="rue" value = '.$data_add['rue'].' size="30" disabled="disabled" />';
                echo '<label for="adresse">Adresse :</label>';
                echo '<input type="text" id="adresse" name="adresse" value = '.$data_add['num'].' size="30" disabled="disabled"/>  ';
                echo '<label for="ville">Ville :</label>';
                echo '<input type="text" id="ville" name="ville" value = '.$data_add['ville'].' size="30" disabled="disabled"/>  ';
                echo '<label for="postal">Code postal :</label>';
                echo '<input type="text" id="postal" name="postal" value = '.$data_add['code_postal'].' size="30" disabled="disabled"/> ';
                echo '<a href ="page_adresse.php"> <button type="submit"class="button" id="edit" >Editer </button> </a>';
                }
                else {
                    echo '<label for="rue">N° Rue :</label>';
                    echo '<input type="text" id="rue" name="rue" size="30" disabled="disabled" />';
                    echo '<label for="adresse">Adresse :</label>';
                    echo '<input type="text" id="adresse" name="adresse" size="30" disabled="disabled"/>  ';
                    echo '<label for="ville">Ville :</label>';
                    echo '<input type="text" id="ville" name="ville" size="30" disabled="disabled"/>  ';
                    echo '<label for="postal">Code postal :</label>';
                    echo '<input type="text" id="postal" name="postal" size="30" disabled="disabled"/> ';
                    echo '<a href ="page_adresse.php"> <button type="submit" class="button" id="edit" > Editer </button> </a>';
                }
            ?>
            </p>
        </fieldset>


    <fieldset>
        <legend id="info">Informations personnelles</legend>
        <p> 
            <label for="mail">Email :</label>
            <input type="text" id="mail" name="mail" value =<?php echo $data["mail"];?> size="30" disabled="disabled"/>
            <label for="mail">Mot de passe :</label>
            <input type="text" value = .... id="pass" name="pass" size="30" disabled="disabled"/>
            <label for="tel">Numéro de téléphone :</label>
            <input type="text" id="tel" name="tel" value =<?php echo $data["tel"];?> size="30" disabled="disabled"/>  
            <button type="submit" onclick="window.location.href = 'page_info.php'" class="button" id="edit">Editer</button>
        </p>
    </fieldset>

</body>
<?php
include('footer.php');
?>
</html>