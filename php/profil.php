<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../css/style_profil.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Profil</title>

</head>
<?php include("head.php");?>
<body>
    <?php
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
<!--
    <div class="nav_prof">
        <div class="dropdown">
            <button class="dropbtn">Votre profil 
            <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-content">
                <a href="#identite">Identité</a>
                <a href="#ad">Adresse</a>
                <a href="#info">Info personnelles </a>
                <a href="#">Mot de passe </a>
            </div>
        </div> 
        <a href="#">Paramètres</P></a>
        <a href="#">Signalements</a>
    </div>
-->
    <main>
    <div class='prof'>
        <div class="container">
            <div class="row justify-content-center">
                <legend id ="identite">Votre identité</legend>
                <p>
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value ='<?php echo $data["prenom"];?>' size="30" disabled="disabled"/><br>
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value ='<?php echo $data["nom"];?>' size="30" disabled="disabled"/> <br>
                    <label for="age">Date de naissance :</label>
                    <input type="date" id="date_naissance" name="date_naissance" value =<?php echo $data["date_naissance"];?> size="30" disabled="disabled"/>  
                    <button type="submit" onclick="window.location.href = 'page_ident.php'" class="button" id="edit"  > Editer</button> 
                </p>
            </div>
        </div>
    </div>

    <hr class='sep'>

    <div class ='prof'>
        <div class="container">
            <div class="row justify-content-center">
                <legend id="info">Vos adresse :</legend>
                <p> 
                    <button type="submit" onclick="window.location.href = 'page_adr.php'" class="button" id="mdp_button">Voir vos adresses</button>
                </p>
            </div>
        </div>
    </div>

    <hr class='sep'>

    <div class ='prof'>
        <div class="container">
            <div class="row justify-content-center">
                <legend id="info">Informations personnelles</legend>
                <p> 
                    <label for="mail">Email :</label>
                    <input type="text" id="mail" name="mail" value =<?php echo $data["mail"];?> size="30" disabled="disabled"/><br>
                    <label for="tel">Numéro de téléphone :</label>
                    <input type="text" id="tel" name="tel" value =<?php echo $data["tel"];?> size="30" disabled="disabled"/>  <br>
                    <button type="submit" onclick="window.location.href = 'page_info.php'" class="button" id="edit">Editer</button>
                </p>
            </div>
        </div>
    </div>
    <hr class='sep'>

    <div class ='prof'>
        <div class="container">
            <div class="row justify-content-center">
                <legend id="info">Mot de passe :</legend>
                <p> 
                    <button type="submit" onclick="window.location.href = 'page_mdp.php'" class="button" id="mdp_button">Modifier mot de passe</button>
                </p>
            </div>
        </div>
    </div>

</main>
</body>
<?php
include('footer.php');
?>
</html>