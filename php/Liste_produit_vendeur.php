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
                    if($row['quantite_stock'] <= $row['seuil_alerte']) {
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
            } else {
                header('Location: ./Liste_produit.php');
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
