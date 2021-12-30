<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
    <?php include "navbar.php";
    require "data/db_login.php";
    require "data/functions.php"; ?>
        <?php

        echo "</br>";

        if (isset($_GET['id'])){
            $id=$_GET['id'];
            if ($id=="pwd-mail_error"){
                echo "<p><strong>L'adresse mail ou le mot de passe sont erronés</strong></p>";
            }
            elseif ($id=="connexion_error"){
                echo "<p><strong>Erreur de Connexion</strong></p>";
                //Par exemple essayer de revenir en arrière sur une page être s'être déconnecté
            }
            elseif ($id=="logout"){
                echo "<p><strong>Au revoir</strong></p>";
            }
        }
        
        session_start();
        if(isset($_SESSION['connected'])){

            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
        
            $req="select userid from users where userid = ?";
        
            $stmt = mysqli_prepare($connexion, $req);
            mysqli_stmt_bind_param($stmt, "i", $_SESSION['connected']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        
            foreach ($result as $ligne) $cat = $ligne;
            if (isset($cat)){
                echo "<p>Bonjour <strong>".$_SESSION['connected']."</strong></p>";
                echo "<form action='logout.php' method='post'>
                <input type='submit' name='deconnexion' value='logout'>
                </form>";
                //Si l'utilisateur est connecté, le salut et affiche de bouton de deconnexion 
            }
            
        }
        //Si l'utilisateur est connecté, le salut et affiche de bouton de deconnexion 
        //connexion.php n'utilise pas session_check.php pour éviter une boucle infinie de redirection
        ?>

        <form action='connection_check.php' method='post'>
            Adresse Mail <input type='text' name='mail'>
            <br><br>
            Mot de Passe <input type='password' name='mdp'>
            <br><br>
            <input type='submit' name='ok' value='Connexion'>
        </form>
    </body>
</html>