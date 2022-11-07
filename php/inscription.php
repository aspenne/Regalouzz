<html>
    <head>
        <title>Inscription</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/inscription_connexion.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script>

    </head>

    <header>
    <div>
        <img src="../img/site/logo.png" style="width:50%;height:auto;cursor:pointer;" onclick="window.location.href='./Liste_produit.php'">
    </div>
    </header>
    <body>  
        <div class="inscription_box text-center container" style="width:80%;height:90%">
            <div class="row justify-content-center mt-2">
                <h3>Inscrivez-vous:</h3>
            </div>
                    <form id="Formid" action="./inscription_sql.php" method="post">
                        <div class="row justify-content-center mt-2">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Votre nom :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="text" name="nom" required></br>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Prénom :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="text" name="prenom" required><br>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Email :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="email" name="email" required></br>
                                <?php

                                if(isset($_POST['error'])){
                                    if($_POST['error'] == 'mail'){
                                        echo '<label style="color : red">Erreur : Email déjà utilisée</label>';
                                }
                            }

                        ?>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Téléphone :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="tel"  name="telephone" pattern="0[1-9][0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required><br>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Date de naissance :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="date" name="date_naissance" required><br>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Mot de passe :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input id="mdp" type="password" name="mdp" required><br>
                                <ul>
                                    <li id="longueur">Au moins 8 caractères</li>
                                    <li id="maj">Au moins une majuscule</li>
                                    <li id="min">Au moins une minuscule</li>
                                    <li id="chiffre">Au moins un chiffre</li>
                                    <li id="special">Au moins un caractère spécial parmis : ! - / @ ? $</li>
                                    
                                </ul>
                                <?php

                                if(isset($_POST['error'])){
                                    if($_POST['error'] == 'mdp'){
                                        echo '<label style="color : red">Erreur : Le mot de passe doit faire au minimum 8 caractère</label>';
                                }
                            }

                        ?>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Confirmer mot de passe :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input id="mdp2" type="password" name="mdp1" required><br>
                                <ul>
                                    <li id="identique">Les mots de passe doivent être identiques</li>
                                </ul>
                                <?php

                                if(isset($_POST['error'])){
                                    if($_POST['error'] == 'mdp1'){
                                        echo '<label style="color : red">Erreur : Les mots de passes ne correspondent pas</label>';
                                }
                            }

                        ?>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                                <button type="submit" id="boutton" disabled>Valider</button>
                                <br>
                                <ul>
                                    <li id="js">Vous devez activer Javascript pour vous inscrire</li>
                                <ul>
                            </div>
                        </div>
                        <div class="row justify-content-center mt-3">
                            <div class="col-10 col-sm-10 col-md-6 col-lg-6 col-xl-6">
                            <p class="multiline">Alizon traite les données receuillies à des fins de gestion de la relation client, gestion des commande et des livraisons, pour en savoir plus, veuilez consulter nos <a href="ficher_cgv_cgu" id="cgu">CGU/CGV </a></p>
                            </div>
                        </div>
                    </form>
                    <div class="row justify-content-center mt-3">
                        <h3> Vous avez déjà un compte ?</h3>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-4 col-sm-4 col-md-4 col-lg-4 col-xl-4">
                            <a id="ident" href="./connexion.php" class="button">Identifiez-vous</a>
                        </div>
                    </div>
        </div>
        <script src="../Javascript/Validation.js"></script>
    </body>
    <footer>

    </footer>
</html>