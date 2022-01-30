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
            <?php
            include 'data/functions.php';
            include 'data/db_login.php';

            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
            $bd_get = "SELECT * FROM posts ORDER BY postid DESC";

            $result = mysqli_query($connexion, $bd_get) or die('erreur');


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

