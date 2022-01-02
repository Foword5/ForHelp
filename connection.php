<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Connexion - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include "data/navbar.php"; ?>
        <main>
            <?php
            require "data/db_login.php";

            if (isset($_GET['id'])){
                $id=$_GET['id'];
                if ($id=="pwd-mail_error"){
                    echo "<p style='color=red;'>L'adresse mail ou le mot de passe sont erronés</p>";
                }
                elseif ($id=="connexion_error"){
                    echo "<p style='color=red;'>Erreur de Connexion</p>";
                    //Par exemple essayer de revenir en arrière sur une page être s'être déconnecté
                }
                elseif ($id=="logout"){
                    echo "<p style='color=red;'>Au revoir</p>";
                }
            }
            
            include "connection_check";
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
        </main>
    </body>
</html>