<!DOCTYPE html>
<html lang="fr">
    <body>
        <?php
            require "data/db_login.php";
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
            $bd_get = "SELECT name, categoryid from categories";

            $result = mysqli_query($connexion, $bd_get) or die('erreur');
            $bd="posts";
            mysqli_select_db($bd,$connexion);
            $userid=getUser($connexion,$id);
            $sql=" INSERT INTO `posts` (`postid`, `title`, `text`, `categoryid`, `userid`)
            VALUES
            ('???','$_POST[title]','$_POST[text]','$_POST[categoryid]','$userid[id]')";
            mysql_close($connexion);
            header('Location: writepost.php');
        ?>
    </body>
</html>