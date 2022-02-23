<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Compte - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/account.css" rel="stylesheet"/>
        <link href="styles/index.css" rel="stylesheet"/>
        <script type="module" src="footer.js"></script>


    </head>
    <body>
        <?php include "data/navbar.php"; 
            include "data/functions.php";
            include "data/db_login.php";?>
        <main>
            <?php 
                if(session_status() != PHP_SESSION_ACTIVE){
                    session_start();
                }
                $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
                if(!(isset($_GET["user"]))){
                    header('Location: unknow.php');
                }else{/* affiché quand vous êtes connécté */
                    if(is_numeric($_GET["user"]) && $_GET["user"]!=$_SESSION["connected"]){/* affiché pour les comptes des autres */
                        echo "
                            <profile-image>
                                <img src='data/img/noprofile.png' alt='no-profile-img' style='width: 126px; height: 151px;'>
                            </profile-image>";
                        echo "<div class='user-info'>";
                            echo "<h3>".getUser($connexion,$_GET["user"])["username"]."</h3>";
                            echo "<br/>";
                            echo getUser($connexion,$_GET["user"])["points"] ." points";
                            echo "<br/><br/><br/>";
                        echo "</div>";
                    }else{/* affiché quand c'est votre compte */
                        echo "
                        <profile-image>
                            <img src='data/img/noprofile.png' alt='no-profile-img' style='width: 126px; height: 151px;'>
                        </profile-image>";
                        echo "<div class='user-info'>";
                            echo "<h3>".getUser($connexion,$_SESSION["connected"])["username"]."</h3>";
                            echo "<br/>";
                            echo getUser($connexion,$_GET["user"])["points"] ." points";
                        echo "
                        <div class='button-modif' style='text-align: center;'>
                            <a href='modif-mdp.php'><button id='modif'>Modifier mon mot de passe</button></a><br/>
                            <a href='modif-username.php'><button id='modif'>Modif mon nom d'utilisateur</button></a><br/>
                            <a href='modif-mail.php'><button id='modif'>Modif mon mail</button></a><br/>
                            <a href='delete-user.php'><button id='delete'>Supprimer le compte</button></a>
                        </div>
                        ";
                    }
                }
            ?>
            <?php
                $bd_get = "SELECT * FROM posts WHERE userid = ?";
                $stmt = mysqli_prepare($connexion, $bd_get);
                mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);// le type de ce que tu met (i pour int), puis la variable a associer
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);//tu obtiens une liste de liste
                mysqli_stmt_close($stmt);
            ?>
            <br/><br/><br/>

            <div class='owner_post'>
                <?php
                while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){    
                    echo " <div class='index'>
                                <b id='arbo'>" .getCategoryArbo($connexion, $ligne['categoryid']). "</b>
                                <h3>" .$ligne['title']. "</h3>";
                    if(strlen($ligne["text"])>=200){
                        echo "<p>" .substr($ligne['text'],0,200). "...</p>";
                    }else{
                        echo "<p>" .$ligne['text']. "</p>";
                    }

                    echo "</br>
                        <a href='post.php?post=".$ligne["postid"]."'><button id='voirplus'>Voir plus</button></a>
                    </div>";
                }
                ?>
            </div>
        </main>
    </body>

    <footer>
        <?php include "data/footer.php"; ?>
    </footer> 
</html>