<html>
    <head>
        <title>Demande retour</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_retour.css">
        <link rel="stylesheet" href="../css/foot_head.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    </head>
    <?php
    include("head.php");
    include('id.php');
    ?>
<body>
    <main>
        <h2 id="h2_form"> Formulaire de demande de retour </h2>
        <div id="test">
        <div class="container">
            <div class="row justify-content-center">
                <p><b> Par quel moyen souhaitez vous être remboursé ? </b></p>
                    <div class="col-12">
                        <input type="radio" id="virement" name="remboursement" value="virement">
                        <label for="paypal">Virement</label>
                    </div>
                    
                    <div class="col-12" id="place_iban">
                        <label for="paypal">IBAN</label>
                        <input type="text" id="iban" name="iban" placeholder="FR76 3000 6005 0500 0100 0253 015" size="30" >
                        <p id="erreur_iban">Iban valide</p>
                    </div>

                    <div class="col-12">
                        <input type="radio" id="bonAchat" name="remboursement" value="bonAchat" checked="checked">
                        <label for="bonAchat">Bon d'achat</label>
                    </div>
                    <br><br>
                    <p> <b> Total <?php echo $_SESSION['total']; ?> €  </b></p>
                    <input type="submit" value="Continuer" id="val_retour" onclick="valid()" disabled>
                    
            </div>
        </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <p id="info"> Votre remboursement sera validé dès que la récéption de votre coli aura été validée par le vendeur </p>
            </div>
        </div>
        
        <script src="../Javascript/Iban.js"></script>
    </main>
    <?php
    include("footer.php");
    ?>
</body>
</html>

