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
            if (!$post && !isset($GET["noredirect"])) header("Location:unknow.php");
            else if(!$post) header("Location:index.php");

            $author = getUser($connexion,$post["userid"]);            
        }else header("Location:unknow.php"); 
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    ?>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $post["title"]; ?> - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        
        <link href="styles/post.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include "data/navbar.php"; ?>
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
                <table id="post_bot">
                    <tr>
                        <td><?php echo printProfile($connexion,$author["userid"])?></td>
                        <td class="table_right"><a href="writeanswer.php?post=<?php echo $postid;?>"><button>Écrire une réponse</button></a>
                        <?php
                            if(isset($_SESSION["connected"]) && getPost($connexion,$postid)["userid"] == $_SESSION["connected"])
                                echo "<a href='confirm_delete.php?post=".$postid."&url=".$_SERVER['REQUEST_URI']."'><button class='red_button'>Supprimer</button></a>";
                        ?>
                        </td>
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
                    echo "
                        <div class='answer'>
                            <div class='answer_top'>
                                ".printProfile($connexion,$answer["userid"]);
                                if($answer["isgood"] == 1) echo"<img src='data/img/check.png' alt='Good answer' class='check_img' title='Réponse validé par l'auteur'>";
                                if(isset($_SESSION["connected"]) && $answer["userid"] == $_SESSION["connected"])
                                    echo"<a href='confirm_delete.php?answer=".$answer["answerid"]."&url=".$_SERVER['REQUEST_URI']."'><button>Supprimer</button></a>";
                                if(isset($_SESSION["connected"]) && $author["userid"] == $_SESSION["connected"] && $answer["isgood"]==0)
                                    echo"<a href='actions/action_good_answer.php?good=true&answer=".$answer["answerid"]."&url=".$_SERVER['REQUEST_URI']."'><button class='reponse_button green_button'>Valider la réponse</button></a>";
                                if(isset($_SESSION["connected"]) && $author["userid"] == $_SESSION["connected"] && $answer["isgood"]==1)
                                    echo"<a href='actions/action_good_answer.php?good=false&answer=".$answer["answerid"]."&url=".$_SERVER['REQUEST_URI']."'><button class='reponse_button red_button'>Retirer la validation</button></a>";
                                echo 
                            "</div>
                            <div class='answer_text'>
                                ".$answer["text"]."
                            </div>
                        </div>
                        ";
                }
            ?>
        </main></div>
        <footer>
            <?php include "data/footer.php"; ?>
        </footer> 
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>