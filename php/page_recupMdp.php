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
    }
    catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
    ?>
<body>
    <main>
        <h2 id ="titre"> Modification mot de passe </h2>
        
        <?php
        $data=$dbh->query('SELECT * FROM alizon._client WHERE mail =\''.$_GET['mail'].'\'')->fetch();
        if (isset($_GET['id']) && isset($_GET['mdp'])){
            if (md5($data['id_client']) != $_GET['id']){
                header('Location: ./connexion.php');
            }
        }
        
        ?>
            <form method="post" action="redirRecup.php">
                 <?php
                    echo '<input id="id_client" name="id_client" value="'.$data["id_client"].'" type="hidden">';
                ?>
                <div class ='prof'>
                    <div id='mdp_form'>
                        <div class="container">
                        <div class="row justify-content-center">
                            <div id='mdp_form2'>

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
    </main>
</body>
</html>
