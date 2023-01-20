<?php
    include("id.php");
    try {
        $destination = '../img/produit/'.$_POST['ID'];
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("UPDATE Alizon._Produit SET libelle = ?, descr = ?, prix_ht = ?, seuil_alerte = ? WHERE ID_Produit = ?");
        $res = $stmt->execute([$_POST['nomProduit'],$_POST['description'],$_POST['prixProduit'],$_POST['seuilProduit'],$_POST['ID']]);
        if($_POST['suppFichier'] == 'oui') {
            for($i=1; $i <= 3; $i++) { // supprime tous les fichiers (images) du dossier correspondant
                unlink('../img/produit/'.$_POST['ID'].'/'. $i . '.jpg');
                unlink('../img/produit/'.$_POST['ID'].'/'. $i . '.png');
            }
        }
        $max_file_size = 2 * 1024 * 1024; // 2 Mo
        // Si il y a une première photo
        if(!$_FILES['imgProduit1']['error'] == UPLOAD_ERR_NO_FILE) {
            if($_FILES['imgProduit1']['size'] <= $max_file_size) { // vérification taille
                $path = $_FILES['imgProduit1']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if($ext == 'jpg' || $ext == 'jpeg') {
                    $origine = $_FILES['imgProduit1']['tmp_name'];
                    $destination = '../img/produit/'.$_POST['ID'].'/1.jpg';
                    move_uploaded_file($origine,$destination);
                } else if($ext == 'png') {
                    $origine = $_FILES['imgProduit1']['tmp_name'];
                    $destination = '../img/produit/'.$_POST['ID'].'/1.png';
                    move_uploaded_file($origine,$destination);
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("Votre première image est trop lourde (maximum 2 Mo)");
                </script>
                <?php
            }
        }
        // Si il y a une deuxième photo
        if(!$_FILES['imgProduit2']['error'] == UPLOAD_ERR_NO_FILE) {
            if($_FILES['imgProduit2']['size'] <= $max_file_size) { // vérification taille
                $path = $_FILES['imgProduit2']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if($ext == 'jpg' || $ext == 'jpeg') {
                    $origine = $_FILES['imgProduit2']['tmp_name'];
                    $destination = '../img/produit/'.$_POST['ID'].'/2.jpg';
                    move_uploaded_file($origine,$destination);
                } else if($ext == 'png') {
                    $origine = $_FILES['imgProduit2']['tmp_name'];
                    $destination = '../img/produit/'.$_POST['ID'].'/2.png';
                    move_uploaded_file($origine,$destination);
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("Votre deuxième image est trop lourde (maximum 2 Mo)");
                </script>
                <?php
            }
        }
        // Si il y a une troisième photo
        if(!$_FILES['imgProduit3']['error'] == UPLOAD_ERR_NO_FILE) {
            if($_FILES['imgProduit3']['size'] <= $max_file_size) { // vérification taille
                $path = $_FILES['imgProduit3']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if($ext == 'jpg' || $ext == 'jpeg') {
                    $origine = $_FILES['imgProduit3']['tmp_name'];
                    $destination = '../img/produit/'.$_POST['ID'].'/3.jpg';
                    move_uploaded_file($origine,$destination);
                } else if($ext == 'png') {
                    $origine = $_FILES['imgProduit3']['tmp_name'];
                    $destination = '../img/produit/'.$_POST['ID'].'/3.png';
                    move_uploaded_file($origine,$destination);
                }
            } else {
                ?>
                <script type="text/javascript">
                    alert("Votre troisième image est trop lourde (maximum 2 Mo)");
                </script>
                <?php
            }
        }
        ?>
        <script type="text/javascript">
            alert("Vos modifications ont été prise en compte");
            window.location.href = "detail_produit.php?ID=" + <?php echo $_POST['ID'] ?>;
        </script>';
        <?php
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
?>
