<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle demande - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'data/navbar.php'; 
            include 'session_check.php'?>
        <main>
            <div class="box">
                <form action="sendpost.php" method="POST" class="post-form">
                    <input type="text" class="proposition-input" placeholder="nom du post" name="nom" required="True">
                    <br />
                    <textarea class="proposition-textarea" placeholder="description de la question" name="description" required="True"></textarea>
                    <br />
                    <select class="inscription-select" name="categoryid" required="True">
                        <option disabled="" selected="">Catégorie</option>
                        <option disabled="">-----------------------------</option>
                        <?php
                            include 'data/functions.php';
                            include 'data/db_login.php';

                            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
                            $bd_get = "SELECT * FROM categories";

                            $result = mysqli_query($connexion, $bd_get) or die('erreur');
                            
                            
                            while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                                echo "<option>";
                                if($ligne["parent"]==NULL){
                                    echo "---".$ligne["name"]."---";
                                }else{
                                    echo $ligne["name"];
                                }
                                echo "</option";
                                if($ligne["parent"]==NULL){
                                    echo" value = '".$ligne["name"]."'>";
                                }else{echo ">";}
                            }
                        ?>
                        <option disabled="">-----------------------------</option>
                    </select>
                    <button type="submit" class="proposition-bouton" name="submit">Poster</button>
                </form>
            </div>
        </main>
    </body>
</html>