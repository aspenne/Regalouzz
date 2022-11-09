<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

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

<?php include('./head.php'); ?>
  <body>
    <?php
        include('id.php');
       
        try {
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
            $produit = $dbh->query("SELECT * FROM Alizon.produit WHERE id_produit =".$_GET['ID'], PDO::FETCH_ASSOC) -> fetch();
            $nom_dossier = '../img/produit/'.$produit['id_produit'].'/';
            $dossier = opendir($nom_dossier);
                
            while($fichier = readdir($dossier))
            {
                if($fichier != '.' && $fichier != '..')
                {
                    $chaine[]= $fichier;
                }
            }
            closedir($dossier);

            echo'
            <script>
                function imgChange(src) {
                    document.getElementById("main").setAttribute("src",src);
                }
            </script>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-3 col-lg-2 col-xl-2">';
                        foreach($chaine as $image)
                        {
                            echo '<button type="button" onclick="imgChange(\''.$nom_dossier.$image.'\')"><img style="height:150px;width:150px;object-fit: contain;" src="'.$nom_dossier.$image.'" alt="..."></button>';
                        }
                    echo'</div>';
                    echo'<div class="col-12 col-sm-12 col-md-9 col-lg-4 col-xl-4">';
                          echo'<img id="main" class="img-fluid" style="max-height:500px;height : auto;width:auto;" src="'.$nom_dossier.$chaine[0].'" alt="...">';
                    echo'</div>';
                    echo'<div class="col-11 col-sm-11 col-md-11 col-lg-4 col-xl-4 align-self-center">';
                        echo'<h1>'.$produit['libelle'].'</h1>
                        <p>Consequat irure ut eiusmod cillum aliquip officia eu culpa consectetur velit. Amet anim tempor aute veniam in pariatur sunt quis adipisicing exercitation. Ullamco qui ea labore fugiat Lorem veniam laboris quis minim irure deserunt magna est. Nisi cillum aliqua proident proident eiusmod exercitation enim amet ipsum.Laborum ea aliquip sint dolore incididunt dolore id proident occaecat. Eu tempor adipisicing voluptate officia dolor tempor elit qui Lorem. Consequat do ullamco anim dolor dolor mollit occaecat occaecat deserunt anim aute. Deserunt do ad id tempor. Aliqua ut proident qui id duis. Sit sunt exercitation ad cillum laboris velit.</p>
                        <h2>'.$produit['prix_ttc'].'€ TTC</h2>
                        <h6>'.$produit['prix_ht'].'€ HT</h6>
                        
                    </div>';
                    echo'<div class="align-self-center col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2" style="text-align: center;">';
                    if(!isset($_SESSION['id_vendeur'])){
                        echo'<div  style="text-align: center; background-color: #CCCCCC; min-width:150px;width:75%; height:auto; border-radius: 25px;padding: 20px; align-self : center;">
                            <p><img src="../img/site/panier.png" style="height:100px;width:100px;object-fit: contain;" alt="panier"></p>
                            <form method="post" action="ajouter_produit.php" id="panier">
                                <label for="quantite">Quantité :</label>
                                <input type="number" id="quantite" name="quantite" min="1" max="100" value="1">
                                <input type="text" id="id_produit" name="id_produit" value="'.$produit['id_produit'].'" hidden>
                            </form>
                            <p><button id="BoutonPanier" type="button" class="btn btn-primary" style="width:75%; height:auto;" onclick="document.getElementById(\'panier\').submit();"><i class="fa-solid fa-cart-shopping"></i><br>Ajouter au panier</button></p>';
                            if(isset($_GET["Panier"])){
                                echo'<script>document.getElementById("BoutonPanier").style.backgroundColor="green";
                                document.getElementById("BoutonPanier").style.borderColor="green";
                                setTimeout(afterClick, 3000);
                                function afterClick(){
                                    document.getElementById("BoutonPanier").style.backgroundColor="#007bff";
                                    document.getElementById("BoutonPanier").style.borderColor="#007bff";
                                }</script>';
                            }
                            if(isset($_SESSION['id_client'])){
                                echo'<p><button type="button" class="btn btn-primary" style="width:75%; height:auto;"><i class="fa-solid fa-heart-circle-plus"></i><br>Ajouter à la liste de souhait</button></p>';
                            }
                            
                        echo'</div>';
                    }
                    elseif($_SESSION['id_vendeur']==$produit['id_vendeur']){
                        echo'<div  style="text-align: center; background-color: #CCCCCC; min-width:150px;width:75%; height:auto; border-radius: 25px;padding: 20px; align-self : center;">
                            <p><button type="button" class="btn btn-primary" style="width:75%; height:auto;"><i class="fa-solid fa-pen"></i> <br>Modifier Article</button></p>

                            <p><button type="button" class="btn btn-primary" style="width:75%; height:auto;"><i class="fa-solid fa-eye-slash"></i><br>Masquer Article</button></p>
                            <p><button type="button" class="btn btn-primary" style="width:75%; height:auto;"><i class="fa-solid fa-trash"></i><br>Supprimer Article</button></p>
                            </div>';
                    }
                    else{
                        echo'<script>window.location.replace("./Liste_produit.php");</script>';
                    }
                    echo'</div>';

                echo'</div>';
            echo'</div>';

            ?>
            <?php

        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    ?>
  </body>
