<?php
    //$destination = '../img/produit/' . $_GET['ID'] . '/1';
    //move_uploaded_file($_FILES['imgProduit']['tmp_name'],$destination);
    include("id.php");
    try {
        $destination = '../img/produit/'.$_POST['ID'];
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE Alizon._Produit SET libelle = ?, descr = ?, prix_ht = ?, seuil_alerte = ? WHERE ID_Produit = ?");
        $res = $stmt->execute([$_POST['nomProduit'],$_POST['description'],$_POST['prixProduit'],$_POST['seuilProduit'],$_POST['ID']]);
        $fi = new FilesystemIterator($destination, FilesystemIterator::SKIP_DOTS); // compte le nombre de fichiers dans le dossier
        $nbFile = iterator_count($fi);
        if($_POST['suppFichier'] == 'oui') {
            for($i=0; $i <= $nbFile; $i++) {
                unlink('../img/produit/'.$_POST['ID'].'/'. $i . '.jpg');
                unlink('../img/produit/'.$_POST['ID'].'/'. $i . '.png');
            }
            $nbFile = 0;
        }
        $total = count($_FILES['imgProduit']['name']);
        $total += $nbFile;
        $iterFile = 0;
        for($i=$nbFile + 1; $i <= $total; $i++) {
            $origine = $_FILES['imgProduit']['tmp_name'][$iterFile];
            $destination = '../img/produit/'.$_POST['ID'].'/'.$i.'.jpg';
            move_uploaded_file($origine,$destination);
            $iterFile++;
        }
        header('location:detail_produit.php?ID='.$_POST['ID']);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>