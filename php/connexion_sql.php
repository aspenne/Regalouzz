<?php

    session_start();
    include('id.php');
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    $valeurs = $_GET;
    $mail = strval($valeurs['email']);
    $mdp = md5(strval($valeurs['mdp']));

    $id = $dbh->query("Select count(id_client) from Alizon._Client WHERE mail='".$mail."' AND mot_de_passe='".$mdp."'", PDO::FETCH_ASSOC)->fetch();
    if($id['count']==1){
        $id = $dbh->query("SELECT * FROM Alizon._Client WHERE mail='".$mail."'", PDO::FETCH_ASSOC) -> fetch();
        $_SESSION['id_client'] = $id['id_client'];
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