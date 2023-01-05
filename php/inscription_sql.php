<?php
session_start();
include('id.php');


$valeurs = $_POST;

$nom = strval($valeurs['nom']);
$prenom = strval($valeurs['prenom']);
$email = strval($valeurs['email']);
$telephone = strval($valeurs['telephone']);
$date_naissance = strval($valeurs['date_naissance']);
$mdp = md5(strval($valeurs['mdp']));
$mdp1 = md5(strval($valeurs['mdp1']));

$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

$existe = $dbh->query("Select count(id_client) from Alizon._Client WHERE mail='".$email."'", PDO::FETCH_ASSOC)->fetch();
print_r($existe);
if($existe['count']==1){
    echo'<form action="./inscription.php" method="post">
        <input type="text" name="error" value="mail">
    </form>
    <script>
        document.forms[0].submit();
    </script>';
}
else{
    if(strval(strlen($valeurs['mdp'])) < "8"){
        echo'<form action="./inscription.php" method="post">
            <input type="text" name="error" value="mdp">
        </form>
        <script>
            document.forms[0].submit();
        </script>';
    }else{
        if($mdp!=$mdp1){
            echo'<form action="./inscription.php" method="post">
                <input type="text" name="error" value="mdp1">
            </form>
            <script>
                document.forms[0].submit();
            </script>';
        }
        else{
            $dbh->exec("INSERT INTO Alizon._client(nom, prenom, mail, tel, date_naissance, mot_de_passe) VALUES ('". strip_tags($nom) . "', '". strip_tags($prenom) . "', '$email', '$telephone', '$date_naissance', '". strip_tags($prenom) . "')");
            $id = $dbh->query("SELECT * FROM Alizon._Client WHERE mail='".$email."'", PDO::FETCH_ASSOC) -> fetch();
            $_SESSION['id_client'] = $id['id_client'];

            if(isset($_COOKIE["panier"])){
                $panier = unserialize($_COOKIE["panier"]);
                foreach($panier as $key => $value){
                    $dbh->exec("INSERT INTO Alizon._Panier(id_client, id_produit, quantite) VALUES (".$_SESSION['id_client'].", ".$key.", ".$value.")");
                }
                setcookie("panier", "", time() - 3600);
            }
    
            header('Location: Liste_produit.php');
        }
    }
   
}


?>