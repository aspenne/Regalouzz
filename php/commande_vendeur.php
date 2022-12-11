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
$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$commandes = $dbh->query("SELECT * from alizon.commande where id_vendeur = ".$_SESSION['id_vendeur']."order by id_commande desc",PDO::FETCH_ASSOC);
echo'<div class="container-fluid">';
foreach ($commandes as $row) {
echo'<div class="row justify-content-center" style="margin: 10px;border : 3px solid #878787;border-radius:30px">';
echo'<div class="col-12 col-sm-12 col-md-12 col-lg-2 col-xl-2" style="text-align: center;">';
echo'<h3> Commande n°'.$row['id_commande'].'</h3>';
echo'</div>';
echo'<div class="col-12 col-sm-12 col-md-12 col-lg-3 col-xl-3">';
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
        
    echo'<img id ="images" src="'.$nom_dossier.$chaine[0].'" style="object-fit: contain;height : 250px;width:100%; margin:2px; border-radius:30px;">';
echo'</div>';
echo'<div class="col-6 col-sm-6 col-md-6 col-lg-2 col-xl-2">';
echo'<h3>'.$row['libelle'].'</h3>';
echo'<p>Prix unitaire : '.$row['prix_ttc'].'€ TTC</p>';
echo'<p>Quantité : '.$row['quantite'].'</p>';
echo'<p>Total : '.$row['prix_ttc']*$row['quantite'].'€</p>';
echo'</div>';
echo'<div class="col-6 col-sm-6 col-md-6 col-lg-4 col-xl-4">';
echo'<h3>Informations client</h3>';
echo'<p>Nom : '.$row['nom'].'</p>';
echo'<p>Prénom : '.$row['prenom'].'</p>';
echo'<p>Mail : '.$row['mail'].'</p>';
echo'<p>Telephone : '.$row['tel'].'</p>';
echo'</div>';
echo'</div>';

}
echo'</div>';

?>