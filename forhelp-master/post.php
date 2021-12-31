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

            $autor = getUser($connexion,$post["userid"]);            
        }else header("Location:unknow.html"); 
    ?>
    <head>
        <meta charset="UTF-8">
        <title>ForHelp - <?php echo $post["title"]; ?></title>
        <link href="styles/style.css" rel="stylesheet"/>

        <link href="styles/post.css" rel="stylesheet"/>
    </head>
    <body>
        <?php
            include "navebar.php";
        ?>
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

        <?php
            // ------Answers

            $req="SELECT * from answers where postid = ? ORDER BY isgood DESC";

            $stmt = mysqli_prepare($connexion, $req);
            mysqli_stmt_bind_param($stmt, "i", $postid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            foreach($result as $answer){
                if($answer["isgood"] == 1){
                    echo "
                        <div class='answer'>
                            <div class='answer_top'>
                                <img src='data/img/check.png' alt='Good answer' class='check_img' title='Réponse validé par l'auteur'>
                                ".getUser($connexion,$answer["userid"])["username"]."
                            </div>
                            <div class='answer_text'>
                                ".$answer["text"]."
                            </div>
                        </div>
                        ";
                }else{
                    echo "
                        <div class='answer'>
                            <div class='answer_top'>
                                ".getUser($connexion,$answer["userid"])["username"]."
                            </div>
                            <div class='answer_text'>
                                ".$answer["text"]."
                            </div>
                        </div>
                        ";
                }
            }
        ?>
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>