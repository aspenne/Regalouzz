<?php

    session_start();
    session_destroy();
    header('Location: Liste_produit.php');

?>