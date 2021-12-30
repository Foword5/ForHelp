<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>répondre - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
    <?php include 'navbar.php'; ?>
        <?php
            if(isset($_GET["post"])){
                require "data/db_login.php";
                require "data/functions.php";
    
                $connexion=mysqli_connect($host,$login,$mdp,$bdd)
                or die("connexion impossible");

                echo "Vous voulez répondre au post : " . getPost($connexion,$_GET["post"])["title"] ;
            }
        ?>
    </body>
</html>