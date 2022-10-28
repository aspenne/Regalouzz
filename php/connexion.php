<?php
    session_start();
    $_SESSION['id_client'] = 1;
    header('Location: Liste_produit.php');

?>