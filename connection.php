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

            session_start();
            if(isset($_SESSION['connected'])){
                $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
        
                $req="select userid from users where userid = ?";
        
                $stmt = mysqli_prepare($connexion, $req);
                mysqli_stmt_bind_param($stmt, "i", $_SESSION['connected']);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
        
                if ($result){
                    header('Location: index.php');
                    exit(0);
                }
            }
            //connexion.php n'utilise pas session_check.php pour éviter une boucle infinie de redirection

            if (isset($_GET['id'])){
                $id=$_GET['id'];
                if ($id=="pwd-mail_error"){
                    echo "<p style='color:red;'>L'adresse mail ou le mot de passe sont erronés</p>";
                }
                elseif ($id=="connexion_error"){
                    echo "<p style='color:red;'>Veuillez vous connecter</p>";
                    //Par exemple essayer de revenir en arrière sur une page ou il faut s'être déconnecté
                }
                elseif ($id=="logout"){
                    echo "<p style='color:red;'>Au revoir</p>";
                }
            }
            
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