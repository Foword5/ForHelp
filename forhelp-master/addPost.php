<!DOCTYPE html>
<html lang="fr">
    <body>
        <?php
            if(isset($_GET["post"])){
                require "data/db_login.php";
                require "data/functions.php";
    
                $connexion=mysqli_connect($host,$login,$mdp,$bdd)
                or die("connexion impossible");
            }
            mysql_select_db ("Posts", $connexion);
            $userid=getUser($connexion,$id);
            $categoryid=getCategoryArbo($connexion,$id);
            $postid=~~;
            $sql=" INSERT INTO `Posts` (`Title`, `Text`, `categoryid`, `userid`, `postid`)
            VALUES
            ('$_POST[title]','$_POST[text]','$categoryid','$userid','$postid')";
            if (!mysql_query($sql,$connexion))
            {
            die('impossible d’ajouter cet enregistrement : ' . mysql_error());
            }
            echo "L’enregistrement est ajouté ";
            mysql_close($connexion)
        ?>
    </body>
</html>