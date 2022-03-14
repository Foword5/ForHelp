<!DOCTYPE html>
<html lang="fr">
    <?php include "data/navbar.php"; 
        include "data/functions.php";
        include "data/db_login.php";
        
        $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
        if(!(isset($_GET["user"]) || !is_numeric($_GET["user"])))header('Location: unknow.php');
        else{
            $user = getUser($connexion,$_GET["user"]);
            if($user == null)header('Location: unknow.php');
        }
    ?>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $user["username"]?> - Forhelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/account.css" rel="stylesheet"/>

    </head>
    <body>
        <div class="page">
            <main>
                <div id="user-info-overhaul">
                    <?php 
                        if(session_status() != PHP_SESSION_ACTIVE){
                            session_start();
                        }

                        echo "<div id='user-info1'>";
                        echo "<div id='profile-image'>";
                        if($user["profilepic"]){
                            echo "<img src='data:image/jpeg;base64,".base64_encode($user["profilepic"])."'id='profile-image-image'/>";
                        }else{
                            echo "<img src='data/img/noprofile.jpg' alt='profile picture missing' id='profile-image-image' />";
                        }
                        echo "</div>";
                        
                        echo "<div class='user-info2'>";
                        echo "<h3>".$user["username"]."</h3>";
                        echo $user["points"]. ' points';
                        echo "</div></div>";

                        if(isset($_SESSION["connected"]) && $_GET["user"]==$_SESSION["connected"]){
                            echo "
                            <div class='button-modif''>
                                <a href='modif-mdp.php'><button id='modif'>Modifier mon mot de passe</button></a>
                                <a href='modif-username.php'><button id='modif'>Modifier mon nom d'utilisateur</button></a>
                                <a href='modif-mail.php'><button id='modif'>Modifier mon mail</button></a>
                                <a href='modif-pfp.php'><button id='modif'>Modifier ma photo de profile</button></a>
                                <a href='delete-user.php'><button class='red_button' id='delete'>Supprimer mon compte</button></a>
                            </div>
                            ";
                        }
                    ?>
                </div>

                <?php
                    $bd_get = "SELECT * FROM posts WHERE userid = ? ORDER BY postid DESC";
                    $stmt = mysqli_prepare($connexion, $bd_get);
                    mysqli_stmt_bind_param($stmt, "i", $_GET["user"]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                ?>
                <div class='owner_post'>
                    <?php
                    while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){   
                        
                        $bd_get = "SELECT count(answerid) FROM answers WHERE postid = ?";
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "i", $ligne["postid"]);
                        mysqli_stmt_execute($stmt);
                        $answers = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);
                        $answers = mysqli_fetch_array($answers, MYSQLI_ASSOC);

                        echo "<div class='posts'>
                                <div class='info_post'>
                                    <span div='arbo'>" .getCategoryArbo($connexion, $ligne['categoryid']). "</span>
                                    <h3>" .$ligne['title']. "</h3>";
                                if($answers["count(answerid)"] > 1){
                                    echo "<span div='arbo'><span class='highlight'>" .$answers["count(answerid)"]. "</span> réponses</span>";
                                }else if($answers["count(answerid)"] == 0){
                                    echo "<span div='arbo'><span class='highlight'>Aucune</span> réponse</span>";
                                }else{
                                    echo "<span div='arbo'><span class='highlight'>Une</span> réponse</span>";
                                }
                                echo "</div>
                                <div class='button_post'>
                                    <a href='post.php?post=".$ligne["postid"]."'><button>Voir plus</button></a>";
                        if(isset($_SESSION["connected"]) && $_GET["user"]==$_SESSION["connected"]){
                            echo "<a href='confirm_delete.php?post=".$ligne["postid"]."&url=".$_SERVER['REQUEST_URI']."'><button class='red_button'>Supprimer</button></a>";
                        }
                        echo "</div></div>";
                    }   
                    ?>
                </div>
            </main>
        </div>
        <footer>
            <?php include "data/footer.php"; ?>
        </footer> 
    </body>
</html>