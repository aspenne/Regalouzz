<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <nav>
        <img src="../img/site/logo.png" onclick="window.location.href='./Liste_produit.php'" alt="logo" class="logo" style="cursor: pointer;">
        <form action="./Liste_produit.php" id="recherche" method="get">

        </form>
        <div class = "search_box">
            <select name="categorie" form="recherche">
                <?php
                include("id.php");
                $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                foreach($dbh->query('SELECT * from Alizon._Categorie order by ID_Categorie', PDO::FETCH_ASSOC) as $row) {
                    echo'<option value="'.$row['id_categorie'].'">'.$row['libelle'].'</option>';
                }
                ?>
            </select>

            
            <input type="search" placeholder="Rechercher">
            <span class = "fa fa-search" onclick="document.getElementById('recherche').submit();"></span>
        </div>

        <div class ="boutons" id ="btn_head">
            <?php 
                if(isset($_SESSION['id_client'])){
                    echo'<a href="./profil.php" class="button">Compte <i class="fa-solid fa-user"></i> </a>';
                    echo'<a href="./panier.php" class="button">Panier <i class="fa-solid fa-cart-shopping"></i></a>';
                    echo'<a href="#" class="button">Souhait <i class="fa-solid fa-heart-circle-plus"></i></a>';
                    echo'<a href="./deconnexion.php" class="button">Deconnexion <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>';
                }elseif(isset($_SESSION['id_vendeur'])){
                    echo'<a href="./compte.php" class="button">Compte <i class="fa-solid fa-user"></i> </a>';
                    echo'<a href="./import.php" class="button">Importer des produits <i class="fa-solid fa-upload"></i></a>';
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
    <a href="#about">Contact</a>
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