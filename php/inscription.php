<html>
    <head>
        <title>Inscription</title>
        <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../Bootstrap/js/bootstrap.min.js"></script> 

    </head>
    <header>
        <h1>Alizon</h1>
    </header>
    <body>  
        <div class="inscription_box text-center">
                <h3>Inscrivez-vous:</h3>
                    <form action="" method="post">
                        <label>Votre nom :</label>
                        <input type="text" name="nom" required></br>
                        <label>Prénom </label>
                        <input type="text" name="prenom" required><br>
                        <label>Email </label>
                        <input type="email" name="email" required></br>
                        <label>tel </label>
                        <input type="tel"  name="telephone" pattern="06[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" required><br>
                        <label>Date de naissance </label>
                        <input type="date" name="date_naissance" required><br>
                        <label>Mot de passe </label>
                        <input type="password" name="mdp" required><br>
                        <label>Confirmer mot de passe </label>  
                        <input type="password" name="mdp1" required><br>
                        <input class="button validate" type="submit" value="Valider"><br>
                        <p class="multiline">Alizon traite les données receuillies à des fins de gestion de la relation client, gestion des commande et des livraisons, pour en savoir plus, veuilez consulter nos <span class="CG">CGU/CGV </span></p>
                        <h3> Vous avez déjà un compte ?</h3>
                        <input class="button log" type="submit" value="Identifiez-vous">
                    </form>
        </div>
    </body>
    <footer>
        
    </footer>
</html>