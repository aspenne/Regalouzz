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
                <h3>Récupération Identifiant :</h3>
            </div>
                    <form id="Formid" action="./recupId_sql.php" method="get">
                        <div class="row justify-content-center mt-3">
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-end">
                                <label>Téléphone :</label>
                            </div>
                            <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6 text-start">
                                <input type="tel" name="tel" required></br>
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
                                <button type="submit">Valider</button>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 col-lg-2 col-xl-2">
                                <button type="button" onclick="location.href='connexion.php'">Annuler</button>
                            </div>
                        </div>
                    </form>
        </div>
    </body>
    <footer>

    </footer>
