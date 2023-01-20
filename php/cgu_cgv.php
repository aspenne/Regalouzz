<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="../Bootstrap/js/bootstrap.min.js"></script> 
    <link rel="stylesheet" href="../css/foot_head.css">
    <link rel="stylesheet" href="../css/style_cgu_cgv.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<?php
    include("head.php");
?>
<body>
    <main>
        <section class="conteneur">
            <article class="detail_cgu_cgv">
                <ul href="#page">CGU
                    <li href="#page">1</li>
                    <li href="#page">2</li>
                    <li href="#page">3</li>
                    <li href="#page">4</li>
                    <li href="#page">5</li>
                </ul>
                <ul href="#page2">CGV
                    <li href="#page">1</li>
                    <li href="#page">2</li>
                    <li href="#page">3</li>
                    <li href="#page">4</li>
                    <li href="#page">5</li>
                </ul>
            </article>
            <hr class="separation">
            <section class="cgu_cgv">
                <section class="cgu">
                    <iframe src="/img/pdf/cgu.pdf"></iframe>
                </section>
                <section class="cgv">
                    <iframe src="/img/pdf/cgv.pdf"></iframe>
                </section> 
            </section>       
            </section>
        </section>
    </main>
</body>
<footer>
<?php
    include("footer.php");
?>
</footer>
</html>
