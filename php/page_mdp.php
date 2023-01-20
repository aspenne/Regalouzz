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
        <h2 id ="titre"> Modification mot de passe </h2>
        <?php

        include('id.php');

        try {
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }

        if (isset($_POST['old_mdp'])) {
                $old_mdp = $_POST['old_mdp'];
                $new_mdp= $_POST['mdp'];
                $new_mdp2= $_POST['mdp1'];
                $mdp = md5(strval($new_mdp));

                $data = $dbh->query("SELECT * FROM alizon._client  WHERE id_client='".$_SESSION["id_client"]."'", PDO::FETCH_ASSOC)->fetch();

                if($old_mdp == $new_mdp){
                    echo "<p id='old_mdp_new'>Veuillez entrer un nouveau mot de passe</p>";
                }

                else if ($data['mot_de_passe'] != md5(strval($old_mdp))){
                    echo "<p id='old_mdp_inc'>Ancien mot de passe incorrect </p>";
                }

                else {
                    $dbh->query("UPDATE alizon._client SET mot_de_passe = '$mdp' WHERE id_client = '".$_SESSION["id_client"]."'");
                    header('Location: profil.php');
                }   
        }
        ?>
            <form method="post" action="#">
                <div class ='prof'>
                    <div id='mdp_form'>
                        <div class="container">
                        <div class="row justify-content-center">
                            <div id='mdp_form2'>

                                <div class="page_psw">
                                    <article>
                                        <label for="mdp">Ancien mot de passe :</label>
                                        <input type="password" name="old_mdp"size="30" required/>
                                    </article>
                                </div>

                                <div class="page_psw">
                                    <article>
                                        <label for="mdp">Nouveau mot de passe :</label>
                                        <input id="mdp" type="password" name="mdp" required size="30">   
                                    </article> 

                                    <article>           
                                        <ul>
                                            <li id="longueur">Au moins 8 caractères</li>
                                            <li id="maj">Au moins une majuscule</li>
                                            <li id="min">Au moins une minuscule</li>
                                            <li id="chiffre">Au moins un chiffre</li>
                                            <li id="special">Au moins un caractère spécial parmis : ! - / @ ? $</li>
                                        </ul>
                                    </article>
                                    <?php

                                        if(isset($_POST['error'])){
                                            if($_POST['error'] == 'mdp'){
                                                echo '<label style="color : red">Erreur : Le mot de passe doit faire au minimum 8 caractère</label>';
                                            }
                                        }

                                    ?>
                                </div>

                                <div class="page_psw">
                                    <article>
                                        <label for="mdp">Confirmez le nouveau mot de passe :</label>
                                        <input id="mdp2" type="password" name="mdp1" required size="30">
                                    </article>
                                
                                    <article>
                                        <ul>
                                            <li id="identique">Les mots de passe doivent être identiques</li>
                                        </ul>
                                    </article>
                                    
                                    <?php
                                        if(isset($_POST['error'])){
                                            if($_POST['error'] == 'mdp1'){
                                                echo '<label style="color : red">Erreur : Les mots de passes ne correspondent pas</label>';
                                            }
                                        }
                                    ?>
                                </div>
                                </div>
                                </div>
                        </div>
                                <button type="submit" id="boutton" disabled>Enregistrer</button>
                    </div>
                </div>
            </form>
        <script src="../Javascript/Validation.js"></script>
    <main>
</body>
</html>
