<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <nav>
        <img src="../img/site/logo.png" onclick="window.location.href='./Liste_produit.php'" alt="logo" class="logo" style="cursor: pointer;">

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

        <div class ="boutons" id ="btn_head">
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

    <div class="topnav" id="myTopnav">
    <a href="./Liste_produit.php" class="active">Accueil</a>
    <a href="#news">Produits phares</a>
    <a href="#contact">Meilleurs ventes</a>
    <a href="#about">Multimedia</a>
    <a href="#about">Meubles</a>
    <a href="#about">Cuisine</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>
</header>