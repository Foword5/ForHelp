<!DOCTYPE html>
<html lang="fr">
    <head>
            <meta charset="UTF-8">
            <title>Rechercher - ForHelp</title>
            <link href="styles/style.css" rel="stylesheet"/>
            <link href="styles/index.css" rel="stylesheet"/>
    </head>
    <body>

        <?php include "data/navbar.php";?>
        <main>
            <div id="search_fil">
                <form action="index.php" method="GET">
                    <table>
                        <tr>
                            <td><input type="text" name="search" placeholder="Rechercher"></td>
                            <td id="search_td_right"><input type="submit"value="Rechercher" id="submit"></td>
                        <tr>
                    </table>
                </form>
            </div>
            <?php
            include 'data/functions.php';
            include 'data/db_login.php';

            if (isset($_GET['succes'])) {
                if($_GET["succes"] == "mdpsucces") {
                    echo "<p style='color:green;'>Modifié mot de passe avec succès</p>";
                }
                else if ($_GET["succes"] == "usernamesucces") {
                    echo "<p style='color:green;'>Modifié username avec succès</p>";
                }
                else if ($_GET["succes"] == "mailsucces") {
                    echo "<p style='color:green;'>Modifié email avec succès</p>";
                }
            }

            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");



            if(isset($_GET["search"])){
                $bd_get = "SELECT * FROM posts where title like ? or text like ? order by postid ASC; ";
                $search = "%".$_GET["search"]."%";

                $stmt = mysqli_prepare($connexion, $bd_get);
                mysqli_stmt_bind_param($stmt, "ss",$search,$search);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }else{
                $bd_get = "SELECT * FROM posts ORDER BY postid DESC";
                $result = mysqli_query($connexion, $bd_get) or die('erreur');
            }




            //echo "Bonjour " .getUser($connexion,$_SESSION["connected"])["username"];

            while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){    
                echo " <div class='index'>
                            <div class='arbo'>" .getCategoryArbo($connexion, $ligne['categoryid']). "</div>
                            <h3>" .$ligne['title']. "</h3>";
                if(strlen($ligne["text"])>=200){
                    echo "<p>" .substr($ligne['text'],0,200). "...</p>";
                }else{
                    echo "<p>" .$ligne['text']. "</p>";
                }

                echo "</br>
                    <a href='post.php?post=".$ligne["postid"]."'><button class='voirplus'>Voir plus</button></a>
                </div>";
            }

            ?>
        </main>
    </body>
</html>
