<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/inscription_connexion.css">
        <script src="../bootstrap/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    </head>
<header>
    <div class="container">
        <div class="row justify-content-center">
            <img src="../img/site/logo.png" style="width:50%;height:auto;cursor:pointer;" onclick="window.location.href='./Liste_produit.php'">
        </div>
    </div>
</header>
<body>
    <div class="inscription_box text-center container" style="width:80%;height:90%">
        <!-- <div class="row justify-content-center">
            <img src="../img/site/logo.png" style="width:50%;height:auto;cursor:pointer;" onclick="window.location.href='./Liste_produit.php'">
        </div> -->
        <div class="row justify-content-center mt-2">
                <h3>Récupération mot de passe :</h3>
            </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-center">
                            <?php
                                include('id.php');
                                try
                                {
                                    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                                    if (isset($_GET['email'])) {
                                       
                                        // On récupère l'id du client ainsi que le mail afin de pouvoir connecter le client lorsqu'il clique sur le lien.
                                        $recup = $dbh->prepare("SELECT id_client, mot_de_passe FROM alizon._client WHERE mail = ?");
                                        $recup->execute([$_GET['email']]);
                                        $res = $recup->fetch();
                                        $id = md5($res['id_client']);
                                        $lien = 'http://'.$_SERVER['HTTP_HOST'].'/php/page_recupMdp.php?id='.$id."&mdp=".$res["mot_de_passe"]."&mail=".$_GET['email'];
                                        $subject = 'Mot de passe oublié';
                                        $message = "Bonjour, voici un lien pour modifier votre mot de passe : $lien \nCordialement, l'équipe Alizon.";
                                        $headers = 'Content-Type: text/plain; charset="UTF-8"';
                                        $stmt2 = $dbh->prepare("SELECT count(*) FROM alizon._client WHERE mail = ?");
                                        $stmt2->execute([$_GET['email']]);
                                        $res = $stmt2->fetch();
                                        $res = $res['count'];
                                        if ($res != 0){  
                                            if (mail($_GET['email'], $subject, $message, $headers)) {
                                                echo "";
                                            }else {
                                                echo "Une erreur est survenue ! </br>";
                                            }
                                        }
                                        echo "Si votre adresse mail est présente de notre base de données, nous vous avons envoyé un mail.";

                                    }
                                    
                                }
                                catch (PDOException $e)
                                {
                                    print('Erreur : ' . $e->getMessage() . "<br/>");
                                }



                            ?>
                            </div>
                        </div>
                        <?php
                            if(isset($_POST['error'])){
                                echo '<div class="row justify-content-center mt-3">
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                            <label style="color : red">Erreur :</label>
                                        </div>
                                        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                            <label style="color : red">Identifiants incorrects</label>
                                        </div>
                                    </div>';
                            }
                        ?>
                        <div class="row justify-content-center mt-3">
                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <button type="button" onclick="location.href='connexion.php'">Retour Connexion</button>
                            </div>
                        </div>
        </div>
    </body>
    <footer>

    </footer>
