<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/style_prod.css">
    <link rel="stylesheet" href="../css/foot_head.css">

    <link rel="stylesheet" href="../bootstrap/js/bootstrap.js"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
<?php
include('id.php');
include('head.php');


try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    $req = "";
    if(isset($_GET["categorie"])){
        if(isset($_GET["recherche"])){
            $req = "SELECT * FROM Alizon.produit WHERE ID_Categorie = ".$_GET["categorie"]." AND UPPER(libelle) LIKE UPPER('%".$_GET["recherche"]."%') ";
        }
        else{
            $req = "SELECT * FROM Alizon.produit WHERE ID_Categorie = ".$_GET["categorie"];
        }
    }
    else if (isset($_GET['min'], $_GET['max'])) {
        $min1 = (int) $_GET['min'];
        $max1 = (int) $_GET['max'];
        $req = "SELECT * FROM Alizon.produit WHERE prix_ttc BETWEEN ".$min1 ." AND ".$max1;
    }
    else{
        if(isset($_GET["recherche"])){
            $req = "SELECT * FROM Alizon.produit WHERE UPPER(libelle) LIKE UPPER('%".$_GET["recherche"]."%') ";
        }
        else{
            header("Location: ./Liste_produit.php");
        }
    }
    if (!isset($_SESSION['id_vendeur']) AND !isset($_SESSION['admin'])){
        $req = $req . "AND masquer = false";
    }
    else {
        if(isset($_SESSION['id_vendeur'])){
            $req = $req ." AND id_vendeur = ".$_SESSION['id_vendeur'] .";";  
        }
    }
    $data = $dbh->query($req, PDO::FETCH_ASSOC);

                echo '<div class="container">';
                        echo '<h2 id="titre_corps">Résultat de la recherche</h2>';
                        echo '<div class="row justify-content-center">';
                        echo '<form action="detail_produit.php" method="get" id="Detail"></form>';
                        
                        
                        foreach($data as $row) {
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
                        echo '</div>';
            }
            catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }

?>
</body>
<?php
include ('footer.php');
?>
