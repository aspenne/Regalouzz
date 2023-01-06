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
    <link rel="stylesheet" href="../css/style_prod.css">
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_vendeur.css">
  </head>
<?php 
    include('head.php');
    if(!isset($_SESSION['admin']) or $_SESSION['admin'] != TRUE){
        header("location:./Liste_produit.php");
    }
    
    include('id.php');
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $lst_client = $dbh->query("SELECT * FROM alizon._client order by id_client asc");
    //Zone de recherche
    ?>
    <style>
  #formClient {
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #rechercheClient {
    width: 60%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
  }
  button[type="submit"] {
    width: 20%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
  button[type="submit"]:hover {
    background-color: #45a049;
  }
</style>

<form action="recherche_panel_admin.php" method="post" id="formClient">
  <input id="rechercheClient" type="text" placeholder="Rechercher..." name="Info">
  <button type="submit">Rechercher</button>
</form>
    <?php
    echo'<div class="container-fluid">';
        foreach ($lst_client as $row) {
        echo'<div class="row justify-content-center" style="margin: 10px;border : 3px solid #878787;border-radius:30px">';
            echo'<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2" style="display: flex; align-items: center; justify-content: center;">';
                echo'<h3> Client n°'.$row['id_client'].'</h3>';
            echo'</div>';
            echo'<div class="col-12 col-sm-12 col-md-6 col-lg-3 col-xl-3" style="text-align: center;">';
                echo'<h3>Informations client</h3>';
                echo'<p>Nom : '.$row['nom'].'</p>';
                echo'<p>Prénom : '.$row['prenom'].'</p>';
            echo'</div>';
            echo'<div class="col-12 col-sm-12 col-md-6 col-lg-4 col-xl-4" style="text-align: center;">';
                echo'<h3>Informations de connexion</h3>';
                echo'<p>Adresse mail : '.$row['mail'].'</p>';
                echo'<p>Téléphone : '.$row['tel'].'</p>';
            echo'</div>';
            echo'<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2" style="text-align: center;">';
                echo'<h3>Actions</h3>';
                echo'<div class="container-fluid">';
                echo'<div class="row justify-content-center">';
                    echo'<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">';
                    if($row['bloquer']){
                        echo'<p><button type="button" class="btn btn-success" onclick="window.location.href=\'debloquer_client.php?id_client='.$row['id_client'].'\'">Débloquer</button></p>';
                    }
                    else{
                        echo'<p><button type="button" class="btn btn-danger" onclick="window.location.href=\'bloquer_client.php?id_client='.$row['id_client'].'\'">Bloquer</button></p>';
                    }
                    echo'</div>';
                    echo'<div class="col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12">';
                    echo'<p><button type="button" class="btn btn-warning" onclick="window.location.href=\'modifier_client.php?id_client='.$row['id_client'].'\'">Modifier ses informations</button></p>';
                    echo'</div>';
                    echo'<div class="col-6 col-sm-6 col-md-6 col-lg-12 col-xl-12" style="text-align: center;">';
                    echo'<p><button type="button" class="btn btn-info" onclick="window.location.href=\'Commandes_client.php?id_client='.$row['id_client'].'\'">Consulter ses commandes</button></p>';
                    echo'</div>';
                
                
                echo'</div>';    
                echo'</div>';
            echo'</div>';
        echo'</div>';

        }
    echo'</div>';

?>