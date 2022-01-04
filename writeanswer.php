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

            $autor = getUser($connexion,$post["userid"]);            
        }else header("Location:unknow.php"); 
    ?>
    <head>
        <meta charset="UTF-8">
        <title>répondre - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>

        <link href="styles/post.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'data/navbar.php'; ?>
        <main>
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
            <form <?php echo 'action="sendanswer.php?post="'.$_GET["post"]; ?> method="POST" class="post-form">
                <h4 STYLE="padding:0 0 0 20px;"><u>Réponse :</u></h4>
                <textarea class="proposition-textarea" name="description" required=""></textarea>
                <br />
                <button type="submit" class="proposition-bouton" name="submit">Poster</button>
            </form>
        </main>
    </body>
</html>