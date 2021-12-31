<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle demande - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>

        <?php
            if(isset($_GET["post"])){
                $postid=$_GET["post"];

                require "data/db_login.php";
                require "data/functions.php";

                $connexion=mysqli_connect($host,$login,$mdp,$bdd)
                or die("connexion impossible");

                $autor = getUser($connexion,$post["userid"]);            
            }else header("Location:unknow.html"); 

        ?>

        <form action='addPost.php' method='post'>
            Login <input type='text' name='title'>
            <br><br>
            mdp <input type='text' name='text'>
            <br><br>
            <input type='submit' name='ok' value='valider'>
        </form>

    </body>
</html>