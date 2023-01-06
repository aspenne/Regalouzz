<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../bootstrap/js/bootstrap.js"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_prod_vendeur.css">

  </head>
<?php
include('id.php');
include('head.php');

echo '<main>';

echo '<div class=conteneur>';


try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    if(!isset($_GET['vendeur']) and !isset($_SESSION['id_vendeur']) and !isset($_GET["categorie"])){
/******Carousel *******/
    echo '<div class="container-fluid col-md-8 col-10">';
        echo '<div class="row">';
            echo '<article >';
                echo '<div id="carouselExampleCaptions" class="carousel carousel-dark slide" data-bs-ride="carousel">';
                    echo '<div class="carousel-indicators">';
                        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
                        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>';
                        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>';
                    echo '</div>';
                    echo '<div class="carousel-inner">';
                        echo '<div class="carousel-item active">';
                            echo'<figure id="carrou">';
                                echo '<h3 class="container ">';
                                    echo '<strong>Petit biscuit</strong></br>';
                                    echo '<strong>25€</strong>';
                                echo '</h3>';
                                echo '<img src="../img/produit/1/1.jpg" class="d-block w-100" >';
                            echo '</figure>';
                        echo '</div>';

                        echo '<div class="carousel-item">';
                            echo'<figure id="carrou">';
                                echo '<h3 class="container ">';
                                    echo '<strong>Kouign ammann</strong></br>';
                                    echo '<strong>35€</strong>';
                                echo '</h3>';
                                echo '<img src="../img/produit/2/1.jpg" class="d-block w-100" >';
                            echo '</figure>';
                        echo '</div>';

                        echo '<div class="carousel-item">';
                            echo'<figure id="carrou">';
                                echo '<h3 class="container">';
                                    echo '<strong>Crêpes</strong></br>';
                                    echo '<strong>5€</strong>';
                                echo '</h3>';
                                echo '<img src="../img/produit/3/1.jpg" class="d-block w-100" >';
                            echo '</figure>';
                        echo '</div>';

                        echo '<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">';
                            echo '<span class="carousel-control-prev-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Previous</span>';
                        echo '</button>';
                        echo '<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">';
                            echo '<span class="carousel-control-next-icon" aria-hidden="true"></span>';
                            echo '<span class="visually-hidden">Next</span>';
                        echo '</button>';
                    echo '</div>';
                echo '</div>';  
            echo '</article>';
        echo '</div>';
    echo '</div>';
    /**************Fin Carousel ********************* */



    echo '<div class="container">';
    echo '<h2 id="titre_corps"> Nos articles </h2>';
    echo '<div class="row justify-content-center">';
    echo '<form action="detail_produit.php" method="get" id="Detail"></form>';
    foreach($dbh->query('SELECT * from Alizon.Produit where masquer = false order by id_produit', PDO::FETCH_ASSOC) as $row) {
        $nom_dossier = '../img/produit/'.$row['id_produit'].'/';
        $dossier = opendir($nom_dossier);
        $chaine=[];        
        while($fichier = readdir($dossier))
        {
            if($fichier != '.' && $fichier != '..')
            {
                $chaine[]= $fichier;
            }
        }
        closedir($dossier);
        echo '<div id ="article" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3" ><button id="btn" name="ID" type="submit" form="Detail" value="'.$row['id_produit'].'" class="h-100 btn btn-outline-primary"><img id ="images" src="'.$nom_dossier.$chaine[0].'" class="rounded img-fluid"> <p>'.$row['libelle'].'</p> <p id="prix"> '.$row['prix_ttc'].'€</p></button></div>';

    }
    echo '</div>';
    echo '</div>';}
    else{
        /************** VENDEUR **********************/
        if(isset($_GET['vendeur'])){
            if($dbh->query("SELECT * FROM Alizon._Vendeur WHERE hash='".$_GET["vendeur"]."'",PDO::FETCH_ASSOC)->fetch()){
                $id = $dbh->query("SELECT * FROM Alizon._Vendeur WHERE hash='".$_GET["vendeur"]."'", PDO::FETCH_ASSOC) -> fetch();
                $_SESSION =[];
                $_SESSION['id_vendeur'] = $id['id_vendeur'];
                
            }
                header('Location: ./Liste_produit.php');
        }else{
            if(isset($_SESSION['id_vendeur'])){
                echo '<form id="filtre">';
                echo '<h2>Filtres</h2>';
                echo '<button class=all onclick="window.location.href = \'Liste_produit_vendeur.php\';" type="button">Tous les produits</button>';
                echo '<button class=alert onclick="window.location.href = \'Liste_produit_alerte.php\';" type="button">Produits en alerte</button>';
                echo '</form>';
                echo "<hr class=separation>";
                echo '<div class="container">';
                echo '<h2 id="titre_corps"><span class=mot1>Vos</span> <span class=mot2>articles</span> </h2>';
                echo '<div class="row justify-content-center">';
                echo '<form action="detail_produit.php" method="get" id="Detail"></form>';
                foreach($dbh->query("SELECT * FROM Alizon.Produit WHERE id_vendeur='".$_SESSION["id_vendeur"]."' ORDER BY id_produit", PDO::FETCH_ASSOC) as $row) {
                    $nom_dossier = '../img/produit/'.$row['id_produit'].'/';
                    $dossier = opendir($nom_dossier);
                    $chaine=[];
                    while($fichier = readdir($dossier))
                    {
                        if($fichier != '.' && $fichier != '..')
                        {
                            $chaine[]= $fichier;
                        }
                    }
                    closedir($dossier);
                    if($row['quantite_stock'] <= 10) {
                        echo '<div id ="article" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-4" >
                                <button id="btn" name="ID" type="submit" form="Detail" value="'.$row['id_produit'].'" class="alert_prd h-100 btn btn-outline-primary">
                                    <div class="lines"></div>
                                    <img id ="images" src="'.$nom_dossier.$chaine[0].'" class="rounded img-fluid"> 
                                    <p>'.$row['libelle'].'</p> 
                                    <p>⚠️ En stock : ' . $row['quantite_stock'] . ' ⚠️</p> 
                                    <p id="prix"> '.$row['prix_ttc'].'€</p>
                                    
                                </button>
                            </div>';
                    } else {
                        echo '<div id ="article" class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-4" >
                            <button id="btn" name="ID" type="submit" form="Detail" value="'.$row['id_produit'].'" class="all_prd h-100 btn btn-outline-primary">
                                <img id ="images" src="'.$nom_dossier.$chaine[0].'" class="rounded img-fluid"> 
                                <p>'.$row['libelle'].'</p> 
                                <p id="prix"> '.$row['prix_ttc'].'€</p>
                            </button>
                        </div>';
                    }

                }
                echo '</div>';
                echo '</div>';
            }
        }
    }
    echo '</div>';

    echo'</main>';

    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}




?>
</body>
<?php
include ('footer.php');
?>
