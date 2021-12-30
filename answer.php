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

        
        <form method="POST" action="newanswer.php" class="post-form">
            <!-- chemin d'accès -->
            <a></a>
            <br />
            <!-- post d'origine -->
            <!--
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
                <table id="post_bot">
                    <tr>
                        <td><?php echo $autor["username"]; ?></td>
                        <td class="table_right"><a href="answer.php?post=<?php echo $postid;?>"><button>Écrire une réponse</button></a></td>
                    </tr>
                </table>
            </div>
            -->
            <br />
            <label><b>réponse</b></label>
            <br />
            <textarea class="proposition-textarea" name="description" required=""></textarea>
            <br />
            <button type="submit" class="proposition-bouton" name="submit">Poster</button>
        </form>

    </body>
</html>