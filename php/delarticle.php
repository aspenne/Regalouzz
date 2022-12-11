<?php
$src='../img/produit/'.$_GET['ID'];
if (file_exists($src)) {
    $dir = opendir($src);
    while (false !== ($file = readdir($dir))) {
        if (($file != '.') && ($file != '..')) {
            $full = $src . '/' . $file;
            if (is_dir($full)) {
                rrmdir($full);
            } else {
                unlink($full);
            }
        }
    }
    closedir($dir);
    rmdir($src);
}

include('id.php');
$dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$stmt = $dbh->prepare("DELETE FROM Alizon._produit WHERE id_produit = ?;");
$res = $stmt->execute([$_GET['ID']]);

header("location:./Liste_produit.php");

?>
