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
                    header('Location: unknow.php');
                }else{
                    if(is_numeric($_GET["user"]) && $_GET["user"]!=$_SESSION["connected"]){
                        echo getUser($connexion,$_GET["user"])["username"];
                        echo "<br/>";
                        echo getUser($connexion,$_GET["user"])["email"];
                        echo "<br/>";
                    }else{
                        echo "<account>";
                        echo "Mon compte : ".getUser($connexion,$_SESSION["connected"])["username"];
                        echo "<br/>";
                        echo "Mon email : ".getUser($connexion,$_SESSION["connected"])["email"];
                        echo "</account>";
                        echo "<br/><br/>
                        <a href='edit-account.php'><button class='button-account'>modifier profil</button></a>
                        <a href='edit-psswd.php'><button class='button-account'>changer de mot de passe</button></a>
                        ";
                    }
                }
            ?>
        </main>
    </body>
</html>