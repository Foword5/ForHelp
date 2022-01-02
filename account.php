<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Compte - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include "data/navbar.php"; 
            include "data/functions.php";
            include "data/db_login.php"?>
        <main>
            <?php
                if(session_status() != PHP_SESSION_ACTIVE){
                    session_start();
                }
                $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
                if(!(isset($_GET["user"]))){
                    header('Location: unknow.html');
                }else{
                    if(is_numeric($_GET["user"]) && $_GET["user"]!=$_SESSION["connected"]){
                        echo getUser($connexion,$_GET["user"])["username"];
                    }else{
                        echo "Mon compte : ".getUser($connexion,$_SESSION["connected"])["username"];
                    }
                }
            ?>
        </main>
    </body>
</html>