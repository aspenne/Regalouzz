<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Alizon</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php 
        if(isset($_COOKIE["panier"])){
            echo"<pre>";
            print_r(unserialize($_COOKIE["panier"]));
            echo"</pre>";
        }
    ?>
    <form action="./supprimer.php" method="get">
        <input type="integer" name="idproduit" id="id" value=1 hidden></input>
        <button type="submit">Supprimer du panier le produit 1</button>
    </form>

    <form action="./vider_panier.php" method="post">
        <button type="submit">Vider le panier</button>
    </form>

    <form action="./modifierQuantite.php" method="get">
        <input type="integer" name="idproduit" id="id" value=2 hidden></input>
        <input type="integer" name="quantite" id="quantite"></input>
        <button type="submit">Modifier la quantité du produit 2</button>
    </form>
</body>
</html>