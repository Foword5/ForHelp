<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Fil d'actualité - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/flux.css" rel="stylesheet"/>
        <script src="data/script/flux_script.js"></script>
    </head>
    <body>
        <?php include "data/navbar.php"; 
        include "session_check.php";?>
        <div class="page">
            <main>
                <div id="page_title">Mon flux d'actualité</div>
                <div id="page_description">Ici, vous trouverez toutes les questions des catégories que vous suivez</div>
                <div id="search_fil">
                    <form action="flux.php" method="GET">
                        <?php 
                            if(isset($_GET["id"])){
                                echo"<input type='hidden' name='id' value='".$_GET["id"]."'>";
                            }
                        ?>
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
                    
                    if(isset($_GET["search"]) && isset($_GET["id"])){
                        $bd_get = "SELECT categoryid FROM follow WHERE userid = ? AND categoryid= ?";
                        
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "ii", $_SESSION["connected"],$_GET["id"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $parents = [];
                        while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)) $parents = array_merge($parents,getCategoryChilds($connexion,$ligne['categoryid']));

                        $search = "%".$_GET["search"]."%";

                        if($parents != []){
                            $params = "(".implode(",", array_fill(0, count($parents), "?")).")";
                            $bd_get = "SELECT * FROM posts where categoryid in ".$params." AND (title like ? or text like ?) AND userid != ? order by postid ASC LIMIT 100";
                            $stmt = mysqli_prepare($connexion, $bd_get);
    
                            $types = str_repeat("i", count($parents))."ssi";
                            $args = array_merge(array($stmt,$types), $parents,array($search,$search,$_SESSION["connected"]));
                            ini_set('display_errors', '0');
                            call_user_func_array("mysqli_stmt_bind_param", $args);
                            ini_set('display_errors', '1');
    
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                        }
                    }else if(isset($_GET["id"])){
                        $bd_get = "SELECT categoryid FROM follow WHERE userid = ? AND categoryid= ?";
                        
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "ii", $_SESSION["connected"],$_GET["id"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $parents = [];
                        while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)) $parents = array_merge($parents,getCategoryChilds($connexion,$ligne['categoryid']));

                        if($parents != []){
                            $params = "(".implode(",", array_fill(0, count($parents), "?")).")";
                            $bd_get = "SELECT * FROM posts where categoryid in ".$params." AND userid != ? order by postid ASC  LIMIT 100";
                            $stmt = mysqli_prepare($connexion, $bd_get);
    
                            $types = str_repeat("i", count($parents))."i";
                            $args = array_merge(array($stmt,$types), $parents,array($_SESSION["connected"]));
                            ini_set('display_errors', '0');
                            call_user_func_array("mysqli_stmt_bind_param", $args);
                            ini_set('display_errors', '1');
    
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                        }

                    }else if(isset($_GET["search"])){
                        $bd_get = "SELECT categoryid FROM follow WHERE userid = ?";
                        
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $parents = [];
                        while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)) $parents = array_merge($parents,getCategoryChilds($connexion,$ligne['categoryid']));

                        $search = "%".$_GET["search"]."%";

                        if($parents != []){
                            $params = "(".implode(",", array_fill(0, count($parents), "?")).")";
                            $bd_get = "SELECT * FROM posts where categoryid in ".$params." AND (title like ? or text like ?) AND userid != ? order by postid ASC LIMIT 100";
                            $stmt = mysqli_prepare($connexion, $bd_get);
    
                            $types = str_repeat("i", count($parents))."ssi";
                            $args = array_merge(array($stmt,$types), $parents,array($search,$search,$_SESSION["connected"]));
                            ini_set('display_errors', '0');
                            call_user_func_array("mysqli_stmt_bind_param", $args);
                            ini_set('display_errors', '1');
    
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                        }

                    }else{
                        $bd_get = "SELECT categoryid FROM follow WHERE userid = ?";
                        
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $parents = [];
                        while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)) $parents = array_merge($parents,getCategoryChilds($connexion,$ligne['categoryid']));

                        if($parents != []){
                            $params = "(".implode(",", array_fill(0, count($parents), "?")).")";
                            $bd_get = "SELECT * FROM posts where categoryid in ".$params." AND userid != ? order by postid ASC LIMIT 100";
                            $stmt = mysqli_prepare($connexion, $bd_get);
    
                            $types = str_repeat("i", count($parents)+1);
                            $args = array_merge(array($stmt,$types), $parents,array($_SESSION["connected"]));
                            ini_set('display_errors', '0');
                            call_user_func_array("mysqli_stmt_bind_param", $args);
                            ini_set('display_errors', '1');
    
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);
                        }

                    }

                    if(isset($_GET["search"]) && strlen($_GET["search"]) > 0 && isset($_GET["id"])){
                        echo "<div id='search'>Résultat de la recherche pour \"<span class='colored'>".$_GET["search"]."</span>\" <a href='flux.php?id=".$_GET["id"]."' class='retour'>Annuler</a></div>";
                    }else if(isset($_GET["search"]) && strlen($_GET["search"]) > 0){
                        echo "<div id='search'>Résultat de la recherche pour \"<span class='colored'>".$_GET["search"]."</span>\" <a href='flux.php' class='retour'>Annuler</a></div>";
                    }
                    if(isset($_GET["id"])){
                        $category = getCategory($connexion,$_GET["id"]);
                        if($category){
                            if(isset($_GET["search"])) echo "<div id='category'>Résultat de la recherche dans la catégorie \"<span class='colored'>".$category["name"]."</span>\" <a href='flux.php?search=".$_GET["search"]."' class='retour'>Annuler</a></div>";
                            else echo"<div id='category'>Résultat de la recherche dans la catégorie \"<span class='colored'>".$category["name"]."</span>\" <a href='flux.php' class='retour'>Annuler</a></div>";
                        }
                    }

                    if(mysqli_num_rows($result) == 0){
                        echo "<div class='centered' style='margin-top:5px'>Aucune question trouvée</div>";
                    }

                    foreach($result as $ligne){

                        $bd_get = "SELECT count(answerid) AS nbr FROM answers WHERE postid = ? and isgood = 1";
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "i", $ligne["postid"]);
                        mysqli_stmt_execute($stmt);
                        $answerResult = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $answerResult = mysqli_fetch_array($answerResult, MYSQLI_ASSOC);
                        if($answerResult) $anwser = $answerResult["nbr"];

                        echo " <div class='index'>
                            <div class='arbo'>" .getCategoryArbo($connexion, $ligne['categoryid']). "</div>
                            <h3>" .$ligne['title']. "</h3>";
                        if(strlen($ligne["text"])>=200){
                            echo "<p>" .substr($ligne['text'],0,200). "...</p>";
                        }else{
                            echo "<p>" .$ligne['text']. "</p>";
                        }

                        echo "<div class='index_bottom'>
                            ".printProfile($connexion,$ligne["userid"])."
                            <div class='post_reponse'>";
                                if($anwser>1){
                                    echo "<span class='highlight'>".$anwser."</span>&#160; bonnes réponses";
                                }else if($anwser == 1){
                                    echo "<span class='highlight'>une</span>&#160; bonne réponse";
                                }else{
                                    echo "<span class='highlight'>aucune</span>&#160; bonne réponse";
                                }
                            echo "</div>
                            <a href='post.php?post=".$ligne["postid"]."'><button class='voirplus'>Voir plus</button></a>
                        </div>
                    </div>";
                    }
                ?>
            </main>
            <sidebar id="flux_sidebar">
                <div id="sidebar_title">
                    Les categories que vous suivez
                </div>
                <div id="sidebar_categories">
                    <?php
                        $bd_get = "SELECT categoryid FROM follow where userid = ?";
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        if(mysqli_num_rows($result) == 0){
                            echo "<div class='centered'>Vous ne suivez aucune catégorie.</div>
                            <div class='centered'>Cliquez sur le \"<span class='highlight'>+</span>\" dans l'onglet \"<span class='highlight'>Rechercher</span>\" pour en ajouter.</div>";
                        }

                        while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                            if(isset($_GET["id"]) && $_GET["id"] == $ligne["categoryid"]){
                                echo "<div id='selected_cat' class='followed_category'>".getCategory($connexion,$ligne["categoryid"])["name"];
                                echo "
                                    <div class='ligne invisible'></div>
                                        <span class='unfollow invisible'>
                                            Ne plus suivre
                                        </span>";
                            }else{
                                echo "<div id='".$ligne["categoryid"]."' class='followed_category'>";
                                if(isset($_GET["search"])){
                                    echo "<a href='flux.php?search=".$_GET["search"]."&id=".$ligne["categoryid"]."'>";
                                }else{
                                    echo "<a href='flux.php?id=".$ligne["categoryid"]."'>";
                                }
                                echo getCategory($connexion,$ligne["categoryid"])["name"]."</a>";
                                echo "
                                    <div class='ligne invisible'></div>
                                        <span class='unfollow invisible'>
                                            Ne plus suivre
                                        </span>";
                            }
                            echo "</div>";
                        }
                    ?>
                </div>
                <div class="mettre_a_jour">
                    <a href=''>
                        <button>
                            Mettre à jour
                        </button>
                    </a>
                </div>
            </sidebar>
        </div>
        <footer>
            <?php include 'data/footer.php';?>
        </footer>
    </body>
    <?php
        mysqli_close($connexion);
    ?>
</html>