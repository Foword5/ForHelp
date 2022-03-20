<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle question - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/writepost.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="data/img/logo.png" />
    </head>
    <body>
        <?php include 'data/navbar.php'; 
            include 'session_check.php'?>
        <div class="page"><main>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "cat"){
                        echo "<p style='color:red;'>Veuillez choisir une catégorie</p>";
                    }
                }
            ?>
            <div id="title">Poser une question</div>
            <div id="subtitle">Utilisez [ <span class="highlight">```</span> ] pour ajouter du markdown</div>
            <form action="actions/sendpost.php" method="POST" class="post-form">
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
                        <td id="bottom_writepost">
                            <select id="cat_input" name="categoryid" required>
                                <option disabled selected value="">Catégorie</option>
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
                            <button type="submit" name="post">Poster</button>
                        </td>
                    </tr>
                </table>
            </form>
        </main></div>
        <footer>
            <?php include "data/footer.php"; ?>
        </footer> 
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>