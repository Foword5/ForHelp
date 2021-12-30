<?php
include 'data/functions.php';
include 'bd_login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="styles/style.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
    <nav style="background:#6667ab;">
        <a> bonjour ici c'est la place pour la barre de navigation </a><br />
        <a class="nav-bouton" href="index.php" title="recherche">Recherche</a>
        <a class="nav-bouton" href="writepost.php" title="nouveaupost">Poser une question</a>

        <a class="nav-bouton" href="flux.php" title="actualité">Fil d'actualité</a>
        <a class="nav-bouton" href="account.php" title="compte">Mon compte</a>

        <a class="nav-bouton" href="connexion.php" title="connexion">connexion</a>
        <a class="nav-bouton" href="inscription.php" title="inscription">inscription</a>
    </nav>
    
</body>
</html>