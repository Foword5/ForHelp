<!DOCTYPE html>
<html lang="fr">
    <head>
            <meta charset="UTF-8">
            <title>Rechercher - ForHelp</title>
            <link href="styles/style.css" rel="stylesheet"/>
            <link href="styles/index.css" rel="stylesheet"/>
    </head>
    <body>
        <?php
        include 'navbar.php';
        include 'data/functions.php';
        include 'data/db_login.php';

        $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
        $bd_get = "SELECT * FROM posts";

        $result = mysqli_query($connexion, $bd_get) or die('erreur');


        while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){    
            echo " <div id='index'>
                        <b id='arbo'>" .getCategoryArbo($connexion, $ligne['categoryid']). "</b>
                        <h3>" .$ligne['title']. "</h3>
                        <p>" .$ligne['text']. "</p>
                        </br>
                        <a href='post.php?id=".$ligne["postid"]."'><button id='voirplus'>Voir plus</button></a>
                    </div>
            ";
        }

        ?>
    </body>
</html>

