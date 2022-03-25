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
            $author = getUser($connexion,$post["userid"]);           
        }else header("Location:unknow.php"); 
    ?>
    <head>
        <meta charset="UTF-8">
        <title>Répondre - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/writeanswer.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="data/img/logo.png" />
    </head>
    <body>
        <?php include 'data/navbar.php'; 
            include 'session_check.php'?>
        <div class="page"><main>

            <div id="post">
                <div id="arbo">
                    <?php echo getCategoryArbo($connexion,$post["categoryid"]); ?>
                </div>
                <h3>
                    <?php echo $post["title"] ?>
                </h3>
                <div id="post_container">
                    <p class="post">
                        <?php 
                            $text = nl2br($post["text"]);

                            $i=0;

                            while(str_contains($text,"```")){
                                if($i%2 == 0){
                                    $search = '/'.preg_quote("```", '/').'/';
                                    $text = preg_replace($search, "</p><p class='markdown'>", $text, 1);
                                }else{
                                    $search = '/'.preg_quote("```", '/').'/';
                                    $text = preg_replace($search, "</p><p class='post'>", $text, 1);
                                }
                                $i++;
                            }

                            echo $text;
                        ?>
                    </p>
                </div>
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