<head>
    <title>Alizon</title>
    <script src="../bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_prod.css">

    <link rel="stylesheet" href="../bootstrap/js/bootstrap.js"/>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="../bootstrap/js/bootstrap.bundle.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>

<?php include('./head.php');?>
<?php
    $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    foreach($_POST as $key => $value){
        echo $key . ' : ' . $value . '<br>';
    }
    
    $row = 1;
    if (($handle = fopen($_FILES['fichier']['tmp_name'], "r")) !== FALSE) {
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<div class="col-6">';
        echo '<h2 id="titre_corps"> Les articles dans l\'import </h2>';
        echo '</div>';
        echo '<div class="col-6" style="text-align : end;">';
        echo '<button style="margin: 0 10 0 0; background-color : lightcoral; border-color : red;" onclick="window.location.href=\'./import.php\'">Annuler</button>';
        echo '<button style="margin: 0 0 0 10; background-color : lightgreen; border-color : green" onclick="document.getElementById(\'formimport\').submit();">Importer</button>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row justify-content-center">';
        $import = [];
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
            if($row!=1){
                /* echo'<pre>';
                print_r($data);
                echo'</pre>'; */
                echo '<div id ="article" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3" ><button id="btn" name="ID" class="h-100 btn btn-outline-primary"><img id ="images" src="'.$data[6].'" class="rounded img-fluid"> <p>'.$data[0].'</p><p id="prix"> '.$data[2].'€ HT</p></button></div>';
                $import[] = serialize($data);
            }
            $row++;
        }
    fclose($handle);
    echo '</div>';
    echo '</div>';
    $import1 = serialize($import);

    echo'<form id="formimport" action="./import_sql.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="import" value=\''.$import1.'\'>
    </form>';    
    }

?>