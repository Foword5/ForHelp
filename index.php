<?php
include 'navbar.php';
include 'data/functions.php';

$login = "root";
$mdp = "";
$host = "localhost";
$bdd="projet";
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Fil d'actualité - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>

        <div class="bloc-recherche-post">
        <?php
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
            $bd_get = "SELECT * FROM posts";

            $result = mysqli_query($connexion, $bd_get) or die('erreur');

            while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){    
                echo "<table border='1'><hr>";
                echo "<html><h2>" .getCategoryArbo($connexion,$ligne['categoryid']). "</h2></html>";
                echo "<html><h3>".$ligne['title']."</h3></html>";
                echo $ligne['text'];
                echo "</table>";
            }

            echo "</table>";
        ?>
        </div>

    </body>
</html>