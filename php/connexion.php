<html>
    <head>
        <title>Connexion</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/inscription_connexion.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script>
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
                <h3>Identifiez-vous:</h3>
            </div>
                    <form id="Formid" action="./connexion_sql.php" method="get">
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Email :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="email" name="email" required></br>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Mot de passe :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input id="mdp" type="password" name="mdp" required><i id="confoeil" class="fa-sharp fa-solid fa-eye" onclick="voir()" style="cursor:pointer;padding: 0px 0px 0px 10px;"></i><br>
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
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <button type="submit">Valider</button>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6">
                            <p class="multiline">Alizon traite les données receuillies à des fins de gestion de la relation client, gestion des commande et des livraisons, pour en savoir plus, veuilez consulter nos <a href="ficher_cgv_cgu" id="cgu">CGU/CGV </a></p>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center mt-3">
                        <h3> Vous n'avez pas de compte ?</h3>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <a id="ident" href="./inscription.php" class="button">Inscrivez-vous</a>
                        </div>
                    </div>
        </div>
        <script src="../JavaScript/confoeil.js"></script>
    </body>
    <footer>

    </footer>
