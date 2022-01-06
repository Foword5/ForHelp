<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle question - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/writepost.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'data/navbar.php'; 
            include 'session_check.php'?>
        <main>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "cat"){
                        echo "<p style='color:red;'>Veuillez choisir une </p>";
                    }
                }
            ?>
            <div id="title">Poser une question</div>
            <form action="sendpost.php" method="POST" class="post-form">
                <table>
                    <tr>
                        <td colspan="2">
                            <textarea id="title_input" placeholder="Titre" name="title" required></textarea>
                        </td>
                    </tr><tr>
                        <td colspan="2">
                            <textarea name="text" placeholder="Votre question" required></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select id="cat_input" name="categoryid" required="True">
                                <option disabled="" selected="">Catégorie</option>
                                <?php
                                    include 'data/functions.php';
                                    include 'data/db_login.php';

                                    $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
                                    $catlist = getCatList($connexion);
                                    
                                    foreach($catlist as $cat){
                                        echo "<option value='".$cat[0]."'>";
                                        for($i=0;$i<$cat[2];$i++){
                                            echo "&#160;&#160;&#160;";
                                        }
                                        echo $cat[1]."</option>";
                                    }
                                ?> 
                            </select>
                        </td>
                        <td id="button">
                            <button type="submit" name="post">Poster</button>
                        </td>
                    </tr>
                </table>
            </form>
        </main>
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>