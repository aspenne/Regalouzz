<html>
    <head>
        <title>Demande retour</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="../css/style_retour.css">
        <link rel="stylesheet" href="../css/foot_head.css">
        <link rel="stylesheet" href="../css/style_retour.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    </head>
    <?php
    include("head.php");
    include('id.php');
    ?>
<body>
    <main>
        <h2 id="h2_form"> Votre demande de retour à bien été prise en compte </h2>
        <p id="consignes"> Votre étiquette de retour se télécharge automatiquement <br>
        Si ce n'est pas le cas, veuillez cliquer sur le lien si dessous <br>
        Le vendeur reviendra vers vous sous peu </p>
        <a id="download-link" href="retour.php" download="etiquette_retour.pdf">Télécharger bon retour</a>
        <!-- <button id="boutton_ret" onclick='suppr()'>Retour à l'accueil</button> -->
        
        <input type="submit" value="Retour accueil" id="val_retour" onclick="suppr()">
    </main>

    <script>
        document.getElementById("download-link").click();
    </script>
    <script src="../Javascript/valRetour.js"></script>

    <?php

    include("footer.php");
    ?>
</body>
</html>

