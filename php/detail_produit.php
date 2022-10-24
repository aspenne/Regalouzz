<head>
    <title>Alizon</title>
    <script src="../Bootstrap/js/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
  </head>
  <body>
    <?php
        include('id.php');
       
        try {
            $dbh = new PDO("$driver:host=$server;dbname=$dbname", $user, $pass);
            foreach($dbh->query('SELECT * from Alizon._Produit where ID_Produit = '.$_GET['ID'], PDO::FETCH_ASSOC) as $row) {
                echo "<pre>";
                print_r($row);
                echo "</pre>";
        }
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    ?>
  </body>