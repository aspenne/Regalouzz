<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="../css/style_suiviComm.css"/>
    <link rel="stylesheet" href="../css/style_prod.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_body.css">
    <title>Document</title>
</head>
<body>
<?php 
    include("id.php");
    include("head.php");
    try
    {
        $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $id_vendeur = $_SESSION['id_vendeur'];
            $produit = $dbh->query("SELECT * FROM Alizon._produit WHERE id_produit =".$_GET['ID'], PDO::FETCH_ASSOC) -> fetch();
            echo '<h2 id="titre_corps"> Modifier ' . $produit['libelle'] . '</h2>';
            echo '<main>';
            echo '<form action="modifier_produit_sql.php" method="post" enctype="multipart/form-data" style="width:40%">
                    <input type="hidden" value="'. $_GET['ID'] .'" name="ID">
                    <div class="form-group mt-2">
                        <label for="nomProduit">Nom</label>
                        <input type="text" class="form-control" name="nomProduit" value="'. $produit['libelle'] .'" placeholder="Nom du produit" minlength="5" maxlength="100" required>
                        <div id="passwordHelpBlock" class="form-text">Entre 5 et 100 caractères</div>
                    </div>
                    <div class="form-group mt-2">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" rows="5" placeholder="Description du produit..." spellcheck="false" minlength="20" maxlength="1000" required>'.$produit['descr'].'</textarea>
                        <div id="passwordHelpBlock" class="form-text">Entre 20 et 1000 caractères</div>
                    </div>
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                        <div class="form-group col-auto mt-2">
                            <label for="prixProduit">Prix ( TTC )</label>
                            <input type="number" class="form-control" name="prixProduit" min="0" value="' . $produit['prix_ht'] . '" required>
                        </div>
                        <div class="form-group col-auto mt-2">
                            <label for="seuilProduit">Seuil d\'alerte</label>
                            <input type="number" class="form-control" name="seuilProduit" min="1" value="' . $produit['seuil_alerte'] . '" required>
                        </div>
                    </div>
                    <div class="form-group mt-2 mb-2">
                        <label for="imgProduit">Image principale</label>
                        <input type="file" class="form-control" name="imgProduit1" accept="image/jpeg, image/jpg">
                    </div>
                    <div class="form-group mt-2 mb-2">
                        <label for="imgProduit">Seconde image</label>
                        <input type="file" class="form-control" name="imgProduit2" accept="image/jpeg, image/jpg">
                    </div>
                    <div class="form-group mt-2 mb-2">
                        <label for="imgProduit">Troisième image</label>
                        <input type="file" class="form-control" name="imgProduit3" accept="image/jpeg, image/jpg">
                    </div>
                    <div class="form-group mt-2 mb-2">
                        <input type="checkbox" name="suppFichier" class="form-check-input" value="oui">
                        <label for="suppFichier" class="form-check-label">Supprimer les anciennes images</label>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2 mb-2">Enregistrer</button>
                </form>';
            echo '</main>';
        }

    catch (PDOException $e)
    {       
        print('Erreur : ' . $e->getMessage() . "<br/>");
    }
    include("footer.php");
?>
</body>
</html>
