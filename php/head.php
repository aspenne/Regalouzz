<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://kit.fontawesome.com/67c66657c7.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
</head>
<header>
    <nav>
        <img src="../img/site/logo.png" alt="logo" class="logo">

        <div class = "search_box">
            <select>
                <option value="0">Categories</option>
                <option value="1">categorie 1</option>
                <option value="2">categorie 2</option>
                <option value="3">categorie 3</option>
                <option value="4">categorie 4</option>
                <option value="5">categorie 5</option>
                <option value="6">categorie 6</option>
            </select>

            
            <input type="search" placeholder="Rechercher">
            <span class = "fa fa-search"></span>
        </div>

        <div class ="boutons">
            <?php 
                if(isset($_SESSION['id_client'])){
                    echo'<a href="#" class="button">Compte <i class="fa-solid fa-user"></i> </a>';
                    echo'<a href="./panier.php" class="button">Panier <i class="fa-solid fa-cart-shopping"></i></a>';
                    echo'<a href="#" class="button">Souhait <i class="fa-solid fa-heart-circle-plus"></i></a>';
                    echo'<a href="./deconnexion.php" class="button">Deconnexion <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>';
                }else{
                    echo '<a href="./inscription.php" class="button">Inscription <i class="fa-solid fa-user-plus"></i> </a>';
                    echo '<a href="./connexion.php" class="button">Connexion <i class="fa-solid fa-user"></i></a>';
                    echo'<a href="./panier.php" class="button">Panier <i class="fa-solid fa-cart-shopping"></i></a>';

                }
            ?>
        </div>

    </nav>

    <div class="navbar">
        <ul class="menu">
            <a href="./Liste_produit.php">Accueil</a>
            <a href="#prod_phares">Produits phares</a>
            <a href="#best_ventes">Meilleurs vente</a>
            <a href="#multi">Multimédia</a>
            <a href="#meubles">Meubles</a>
            <a href="#cuisine">Cuisine</a>
        </ul>
    </div>
</header>
