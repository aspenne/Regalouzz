<?php

    session_start();
    if(isset($_SESSION['id_vendeur'])){
        unset($_SESSION['id_vendeur']);
    }
    include('id.php');
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $valeurs = $_GET;
    $mail = strval($valeurs['email']);
    $mdp = md5(strval($valeurs['mdp']));

    $id = $dbh->query("Select count(id_client) from Alizon._Client WHERE mail='".$mail."' AND mot_de_passe='".$mdp."'", PDO::FETCH_ASSOC)->fetch();
    if($id['count']==1){
        $id = $dbh->query("SELECT * FROM Alizon._Client WHERE mail='".$mail."'", PDO::FETCH_ASSOC) -> fetch();
        $_SESSION['id_client'] = $id['id_client'];

        if(isset($_COOKIE["panier"])){
            $panier = unserialize($_COOKIE["panier"]);
            foreach($panier as $key => $value){
                if ($dbh->query("SELECT * from alizon._panier where id_client = ".$_SESSION['id_client']." and id_produit = ".$key."",PDO::FETCH_ASSOC)->fetch()){
                    $dbh->exec("UPDATE alizon._panier set quantite = quantite +".$value." where id_client = ".$_SESSION['id_client']." and id_produit = ".$key."");
                }
                else{
                    try {
                        $dbh->exec("INSERT INTO alizon._panier (id_client, id_produit, quantite) VALUES (".$_SESSION['id_client'].",".$key.",".$value.")");
                    }
                    catch (PDOException $e) {
                        echo " Erreur !". $e->getMessage();
                    }
                }
            }
            setcookie("panier", "", time() - 3600);
        }

        header('Location: Liste_produit.php');
    }
    else{
        echo'<form action="./connexion.php" method="post">
            <input type="text" name="error" value="true">
        </form>
        <script>
            document.forms[0].submit();
        </script>';
    }

?>