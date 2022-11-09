<?php
    include('id.php');
    session_start();
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    foreach($_POST as $key => $value){
        echo $key . ' : ' . $value . '<br>';
    }
    print_r($_POST);
    print_r($_FILES);
    $row = 1;
    if (($handle = fopen($_FILES['fichier']['tmp_name'], "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if($row!=1){;
                $dbh->exec("INSERT INTO Alizon._produit(id_categorie, libelle , descr, sponsorise, prix_ht, code_taxe,quantite_stock,masquer,id_vendeur) VALUES ('$data[4]', '$data[0]', '$data[1]', false, '$data[2]', '$data[3]','$data[5]',false,'$_SESSION[id_vendeur]')");
                mkdir("../img/produit/".$dbh->lastInsertId());
                file_put_contents("../img/produit/".$dbh->lastInsertId()."/1.jpg", file_get_contents($data[6]));
                
            }
            $row++;
        }
    fclose($handle);
}
?>

<script>window.location.replace("./Liste_produit.php");</script>
