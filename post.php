<!DOCTYPE html>
<html lang="fr">
    <?php
        if(isset($_GET["post"])){
            $postid=$_GET["post"];

            require "data/db_login.php";
            require "data/functions.php";

            $connexion=mysqli_connect($host,$login,$mdp,$bdd)
            or die("connexion impossible");

            $post = getPost($connexion,$postid);
            if (!$post) header("Location:unknow.html");


            
        }else header("Location:unknow.html"); 
    ?>
    <head>
        <meta charset="UTF-8">
        <title>ForHelp - <?php echo $post["title"]; ?></title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/post.css" rel="stylesheet"/>
    </head>
    <body>
        <div id="post">
            <div id="arbo">
                <?php echo getCategoryArbo($connexion,$post["categoryid"]); ?>
            </div>
            <h3>
                <?php echo $post["title"] ?>
            </h3>
            <p>
                <?php echo $post["text"] ?>
            </p>
        </div>
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>