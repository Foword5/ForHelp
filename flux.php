<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Fil d'actualité - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/flux.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include "data/navbar.php"; 
        include "session_check.php";?>
        <main>
            <div id="search_fil">
                <form action="flux.php" method="GET">
                    <table>
                        <tr>
                            <td><input type="text" name="search" placeholder="Rechercher"></td>
                            <td id="search_td_right"><input type="submit"value="Rechercher" id="submit"></td>
                        <tr>
                    </table>
                </form>
            </div>

            <?php
                include 'data/functions.php';
                include 'data/db_login.php';

                $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

                if(session_status() != PHP_SESSION_ACTIVE){
                    session_start();
                }
                if(isset($_GET["search"])){
                    $bd_get = "SELECT * FROM posts where categoryid in (select categoryid from follow where userid = ?) and (title like ? or text like ?) order by postid ASC; ";
                    $search = "%".$_GET["search"]."%";

                    $stmt = mysqli_prepare($connexion, $bd_get);
                    mysqli_stmt_bind_param($stmt, "iss", $_SESSION["connected"],$search,$search);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                }else{
                    $bd_get = "SELECT * FROM posts where categoryid in (select categoryid from follow where userid = ?) order by postid ASC";
                    
                    $stmt = mysqli_prepare($connexion, $bd_get);
                    mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);
                }

                foreach($result as $ligne){
                    echo " <div class='index'>
                                <div class='arbo'>" .getCategoryArbo($connexion, $ligne['categoryid']). "</div>
                                <h3>" .$ligne['title']. "</h3>";
                    if(strlen($ligne["text"])>=200){
                        echo "<p>" .substr($ligne['text'],0,200). "...</p>";
                    }else{
                        echo "<p>" .$ligne['text']. "</p>";
                    }

                    echo "</br>
                        <a href='post.php?post=".$ligne["postid"]."'><button class='voirplus'>Voir plus</button></a>
                    </div>";
                }

            ?>
        </main>
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>