<html>
    <head>
        <title>Mot de passe</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_profil.css">
        <link rel="stylesheet" href="../css/foot_head.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
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
<body>
    <main>
    <button type="submit" onclick="window.location.href = 'profil.php'" class="button" id="btn1">Retour profil</button>
    <h2 id="titre"> Votre identité </h2>
    <form method="post" action="page_ident_sql.php">
        <div class ='prof'>
            <div class="container">
                <div class="row justify-content-center">
                    <p>
                        <label for="prenom">Prénom :</label>
                        <input type="text" id="prenom" name="prenom" value ='<?php echo $data["prenom"];?>' size="30" required/>
                        <label for="nom">Nom :</label>
                        <input type="text" id="nom" name="nom" value ='<?php echo $data["nom"];?>' size="30" required/>  
                        <label for="age">Date de naissance :</label>
                        <input type="date" id="date_naissance" name="date" value ='<?php echo $data["date_naissance"];?>' size="30" required/>  
                        <button type="submit" class="button" id="enr"> Enregistrer </button>
                    </p>
                </div>
            </div>
        </div>
    </form>

<?php


?>
        <main>
    </body>
</html>
