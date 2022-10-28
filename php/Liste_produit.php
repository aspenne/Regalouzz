
<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style_prod.css">

    <link rel="stylesheet" href="../bootstrap/js/bootstrap.js"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

  </head>

<?php
include('id.php');
include('head.php');


try {
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    // foreach($dbh->query('SELECT * from Alizon._Produit', PDO::FETCH_ASSOC) as $row) {
    //     echo "<pre>";
    //     print_r($row);
    //     echo "</pre>";
    // }
    
/******Carousel *******/
    echo '<div class="container-fluid col-md-8 col-10">';
        echo '<div class="row">';
            echo '<article >';
                echo '<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">';
                    echo '<div class="carousel-indicators">';
                        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>';
                        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>';
                        echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>';
                    echo '</div>';
                    echo '<div class="carousel-inner">';
                        echo '<div class="carousel-item active">';
                            echo'<figure id="carrou">';
                                echo '<h3 class="container col-md-5 col-md-5  row align-items-center h-100">';
                                    echo '<strong>Des glaces gourmandes à vôtre goût</strong>';
                                echo '</h3>';
                                echo '<img src="../img/produit/1/1.jpg" class="d-block w-100" height="400" width="600">';
                            echo '</figure>';
                        echo '</div>';

                        echo '<div class="carousel-item">';
                            echo'<figure id="carrou">';
                                echo '<h3 class="container col-md-5 col-md-5  row align-items-center h-100">';
                                    echo '<strong>Des glaces gourmandes à vôtre goût</strong>';
                                echo '</h3>';
                                echo '<img src="../img/produit/2/1.jpg" class="d-block w-100" height="400" width="600">';
                            echo '</figure>';
                        echo '</div>';

                        echo '<div class="carousel-item">';
                            echo'<figure id="carrou">';
                                echo '<h3 class="container col-md-5 col-md-5  row align-items-center h-100">';
                                    echo '<strong>Des glaces gourmandes à vôtre goût</strong>';
                                echo '</h3>';
                                echo '<img src="../img/produit/3/1.jpg" class="d-block w-100" height="400" width="600">';
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
    echo '<h2> Nos articles </h2>';
    echo '<div class="row justify-content-center">';
    echo '<form action="detail_produit.php" method="get" id="Detail"></form>';
    foreach($dbh->query('SELECT * from Alizon.Produit order by id_produit', PDO::FETCH_ASSOC) as $row) {

    echo '<div id ="article" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3" ><button id="btn" name="ID" type="submit" form="Detail" value="'.$row['id_produit'].'" class="h-100 btn btn-outline-primary"><img id ="images" src="../img/produit/'.$row['id_produit'].'/1.jpg" class="rounded img-fluid"> <p>'.$row['libelle'].'</p> <p id="prix"> '.$row['prix_ttc'].'€</p></button></div>';

    }
    echo '</div>';
    echo '</div>';
    $dbh = null;
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
