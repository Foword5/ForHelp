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
            if (!$post) header("Location:unknow.php");          
        }else header("Location:unknow.php"); 
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Répondre - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/writeanswer.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'data/navbar.php'; ?>
        <div class="page"><main>
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
            <form action="actions/sendanswer.php?post=<?php echo $postid; ?>" method="POST" id="form">
                <textarea id="text" name="text" required placeholder="Votre réponse"></textarea>
                <div class="right">
                    <button type="submit" id="submit" name="post">Poster</button>
                </div>
            </form>
        </main></div>
        <footer>
            <?php include "data/footer.php"; ?>
        </footer> 
    </body>
</html>