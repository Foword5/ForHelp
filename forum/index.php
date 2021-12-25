<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Accueil - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>

        <h1> Bonjour </h1>

<?php

echo "<br />";

$login = "root";
$mdp = "";
$host = "localhost";
$bdd="projet";

$connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
$bd_get = "SELECT * FROM posts";

$result = mysqli_query($connexion, $bd_get) or die('erreur');


echo "<table>";
echo "<tr>
        <th>Titre</th>
        <th>Categorieid</th>
        <th>ID</th>
        <th>Contenu</th>
    </tr>";

while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo "<tr><td>";
    echo $ligne['title'];
    echo "</td><td>";
    echo $ligne['categoryid'];
    echo "</td><td>";
    echo $ligne['userid'];
    echo "</td><td>";
    echo $ligne['text'];
    echo "</td></tr>";
}

echo "</table>";

?>

    </body>
</html>
