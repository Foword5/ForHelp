<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Compte - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/account.css" rel="stylesheet"/>
        <link href="styles/index.css" rel="stylesheet"/>

    </head>
    <body>
        <?php include "data/navbar.php"; 
            include "data/functions.php";
            include "data/db_login.php";

            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
            if(!(isset($_GET["user"]))){
                header('Location: unknow.php');
            }else{
                if(is_numeric($_GET["user"]) && $_GET["user"]!=$_SESSION["connected"]){
                    echo getUser($connexion,$_GET["user"])["username"];
                }  
            }
            
            $bd_get = "SELECT * FROM posts WHERE userid = ?";
            $stmt = mysqli_prepare($connexion, $bd_get);
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);// le type de ce que tu met (i pour int), puis la variable a associer
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);//tu obtiens une liste de liste
            mysqli_stmt_close($stmt);

            //echo "Bonjour " .getUser($connexion,$_SESSION["connected"])["username"];   
        ?>
        <div class='container'>
            <div class="profile-image">
                <img src="data/img/noprofile.png" width='200' alt='no-profile-img'>
            </div>
            
            <div class='username'>
                <?php echo 'Bonjour ' .getUser($connexion,$_SESSION["connected"])["username"];?>
            </div>
            
            <div class='button-modif'>
                <a href='modif-mdp.php'><button id='modif'>Modifier mon mot de passe</button></a>
                <a href='modif-username.php'><button id='modif'>Modif mon nom d'utilisateur</button></a>
                <a href='modif-mail.php'><button id='modif'>Modif mon mail</button></a>
            </div>

        </div>       

        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>    

        <div class='owner_post'>
            <?php
            while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){    
                echo " <div id='index'>
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
  
    </body>
 
</html>