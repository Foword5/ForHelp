<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle demande - Forum d'entraide</title>
        <link href="/forhelp-master/styles/style.css" rel="stylesheet"/>
    </head>
    <body>
                
        <h1><label for="post">écrire un post:</label></h1>

       
        <form action='addPost.php' method='post'>
            Titre <input type='text' name='title'>
            <br><br>
            Texte <div><input type='text' name='text' style="height:200px;font-size:14pt;"></div>
            <br><br>
            <select name="categorie" id="">
            <option value="" disable>--selectionnez une catégorie--</option>
            <?php
            require "data/db_login.php";
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
            $bd_get = "SELECT name, categoryid from categories";

            $result = mysqli_query($connexion, $bd_get) or die('erreur');
          
            while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){   
                echo "<option value='".$ligne['categoryid']."'>".$ligne['name']."</option> ";

            }
            
            mysqli_close($connexion);
            ?> 
        </select>
            <input type='submit' name='ok' value='valider'>
           
        </form>
        
    </body> 
</html>