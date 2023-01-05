<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<header>
    <nav>
        <img src="../img/site/logo.png" onclick="window.location.href='./Liste_produit.php'" alt="logo" class="logo" style="cursor: pointer;">
        <div class = "search_box">
            <select name="categorie" id="categorie" form="autoCompletion">
                <option value="0">Toutes les catégories</option>
                <?php
                include("id.php");
                $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                foreach($dbh->query('SELECT * from Alizon._Categorie order by ID_Categorie', PDO::FETCH_ASSOC) as $row) {
                    echo'<option value="'.$row['id_categorie'].'">'.$row['libelle'].'</option>';
                }

                $nb_panier = 0;

                
                if(isset($_SESSION["id_client"])){
                    // compte le nombre d'article dans le panier
                    $stmt = $dbh->prepare("SELECT count(*)  FROM alizon._panier WHERE id_client = ".$_SESSION["id_client"]."");
                    $stmt->execute();
                    $res = $stmt->fetchColumn();

                    // compte le nombre d'article dans la liste de souhait
                    $stmt = $dbh->prepare("SELECT count(*)  FROM alizon._listedesouhait WHERE id_client = ".$_SESSION["id_client"]."");
                    $stmt->execute();
                    $res2 = $stmt->fetchColumn();
                }
                ?>
            </select>
            <!--  Mise en place de la requete SQL pour récupérer le nom de l'ensemble des produits dans la BDD -->
            <?php
                include("../php/id.php");
                $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
                $data = $dbh->query("SELECT * FROM Alizon.Produit", PDO::FETCH_ASSOC);
                $dataTab = [];
                foreach($data as $row) {
                    $dataTab[] = $row["libelle"];
                }
            ?>
                <!--  Création du formulaire pour la recherche -->
            <form autocomplete="off" id="autoCompletion" action="./Liste_produit.php" method="get" >
                <div class="autocomplete">
                    <input id="myInput" type="search" value="" placeholder="Rechercher">
                </div>
            </form>

            <span class = "fa fa-search" onclick="rechercher();"></span>
            
        </div>

        <div class ="boutons" id ="btn_head">
            <?php 
                if(isset($_SESSION['id_client'])){
                    $nb_panier = $res;
                    $nb_souhait = $res2;
                    echo'<a href="./profil.php" class="button">Compte <i class="fa-solid fa-user"></i></a>';
                    echo'<a href="./panier.php" class="button" id="button_panier">
                            Panier 
                            <i class="fa-solid fa-cart-shopping"></i> 
                            <span class=notification> ' . $nb_panier . ' </span> 
                        </a>';
                    echo'<a href="./souhait.php" class="button" id="button_souhait" >
                            Souhait
                            <i class="fa-solid fa-heart-circle-plus"></i> 
                            <span class=notification> ' . $nb_souhait . ' </span>
                        </a>';
                    echo'<a href="./deconnexion.php" class="button">Deconnexion <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>';
                }elseif(isset($_SESSION['id_vendeur'])){
                    echo'<a href="./import.php" class="button">Importer des produits <i class="fa-solid fa-upload"></i></a>';
                    echo'<a href="./commande_vendeur.php" class="button">Les Commandes <i class="fa-solid fa-receipt"></i></a>';
                    echo'<a href="./historique_reassort.php" class="button">Historique <i class="fa-solid fa-clipboard-list"></i></a>';
                    echo'<a href="./deconnexion.php" class="button" id="button_panier_cli"> Deconnexion <i class="fa-sharp fa-solid fa-right-from-bracket"></i></a>';
                }else{
                    if (isset($_COOKIE["panier"])){
                        $tab = unserialize($_COOKIE["panier"]);
                        $nb_panier = count($tab);
                    }
                    else $nb_panier = 0;
                    echo '<a href="./inscription.php" class="button">Inscription <i class="fa-solid fa-user-plus"></i> </a>';
                    echo '<a href="./connexion.php" class="button">Connexion <i class="fa-solid fa-user"></i></a>';
                    echo '<a href="./panier.php" class="button" id="button_panier_visiteur" >Panier<i class="fa-solid fa-cart-shopping"></i><span class=notification> ' . $nb_panier . ' </span></a>';

                }
            ?>
        </div>

    </nav>

    <div class="topnav" id="myTopnav">
    <?php
    if(!isset($_SESSION['id_vendeur'])) {
        echo '<a href="./Liste_produit.php" class="active">Accueil</a>';
    }else{
        echo '<a href="./Liste_produit_vendeur.php" class="active">Accueil</a>';
    }
    ?>
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
<!--  Script pour l'auto Complétion réalisée dans la barre de recherche -->
<script src="../Javascript/autoComple.js"></script>
<script>
    var tabM = <?php echo json_encode($dataTab); ?>

    autocomplete(document.getElementById("myInput"), tabM);
</script>
<script src="../Javascript/rechercher.js"></script>
<script src="../Javascript/notif_hover.js"></script>
</header>