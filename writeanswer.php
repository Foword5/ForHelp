<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>répondre - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'data/navbar.php'; ?>
        <main>
            <?php
                if(isset($_GET["post"])){
                    require "data/db_login.php";
        
                    $connexion=mysqli_connect($host,$login,$mdp,$bdd)
                    or die("connexion impossible");

                    echo "Vous voulez répondre au post : " . getPost($connexion,$_GET["post"])["title"] ;
                }
            ?>

            <div class="box">
                <!-- chemin d'accès -->
                <a>chemin d'accès</a>
                <br />
                <!-- post d'origine -->
                <a style="border: thick double #000000">boite contenant le post d'origine</a>
                <?php
                /*<!--<div id="post">
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
                </div>-->*/
                ?>
                <br />
                <form action="newanswer.php" method="POST" class="post-form">
                    <h4>réponse</h4>
                    <textarea class="proposition-textarea" name="description" required=""></textarea>
                    <br />
                    <button type="submit" class="proposition-bouton" name="submit">Poster</button>
                </form>
            </div>
        </main>
    </body>
</html>