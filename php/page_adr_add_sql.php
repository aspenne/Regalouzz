<html>
    <head>
        <title>Profil</title>
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
        $data = $dbh->query("SELECT * FROM alizon._adresse WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();
        
   
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
    <body>
        <main>
    <button type="submit" onclick="window.location.href = 'page_adr.php'" class="button" id="btn1">Retour</button>
    <h2 id='titre'> Entrez votre adresse </h2>
    <form method="post" action="page_adr_add_sql.php">
        <div class ='prof'>
            <div class="container">
                <div class="row justify-content-center">
                    <p>
                        <label for="num">Numéro :</label>
                        <input type="text" name="num" size="30" required />
                        <label for="rue">Rue :</label>
                        <input type="text" name="rue" size="30" required/> 
                        <label for="ville">Ville :</label>
                        <input type="text" name="ville" size="30" required />
                        <label for="postal">Code postal :</label>
                        <input type="text" name="postal" size="30" required/>
                        <label for="pays">Pays :</label>
                        <input type="text" name="pays" size="30" required/>
                        <button type="submit" class="button" id="enr"> Enregistrer </button>
                    </p>
                </div>
            </div>
        </div>
    </form>
</main>
    </body>
<?php

?>
</body>
</html>
