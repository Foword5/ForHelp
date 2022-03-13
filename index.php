<!DOCTYPE html>
<html lang="fr">
    <head>
            <meta charset="UTF-8">
            <title>Rechercher - ForHelp</title>
            <link href="styles/style.css" rel="stylesheet"/>
            <link href="styles/index.css" rel="stylesheet"/>
            <script src="data/script/index_script.js"></script>
    </head>
    <body>

        <?php include "data/navbar.php";?>

        <div class="page">
            <main>
                <div id="page_title">Rechercher des posts</div>
                <div id="page_description">Ici, vous trouverez toutes dernières questions posées sur le site</div>
                <div id="search_fil">
                    <form action="index.php" method="GET">
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
                
                if (isset($_GET['succes'])) {
                    if($_GET["succes"] == "mdpsucces") {
                        echo "<p style='color:green;'>Mot de passe modifié avec succès</p>";
                    }
                    else if ($_GET["succes"] == "usernamesucces") {
                        echo "<p style='color:green;'>Username modifié avec succès</p>";
                    }
                    else if ($_GET["succes"] == "mailsucces") {
                        echo "<p style='color:green;'>Email modifié avec succès</p>";
                    }else if ($_GET["succes"] == "pfpsucces") {
                        echo "<p style='color:green;'>Photo de profile modifié avec succès</p>";
                    }
                }

                $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

                if(isset($_GET["search"]) && isset($_GET['id'])){
                    $id =$_GET['id'];
                    $search = "%".$_GET["search"]."%";
                    $parents = getCategoryChilds($connexion,$_GET['id']);

                    $params = "(".implode(",", array_fill(0, count($parents), "?")).")";
                    $bd_get = "SELECT * FROM posts WHERE (title like ? or text like ?) and categoryid in ".$params." ORDER BY postid DESC limit 100";
                    $stmt = mysqli_prepare($connexion, $bd_get);

                    $types = "ss".str_repeat("i", count($parents));
                    $args = array_merge(array($stmt,$types,$search,$search), $parents);
                    ini_set('display_errors', '0');
                    call_user_func_array("mysqli_stmt_bind_param", $args);
                    ini_set('display_errors', '1');

                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt); 

                }else if(isset($_GET["search"])){

                    $bd_get = "SELECT * FROM posts where title like ? or text like ? order by postid DESC limit 100";
                    $search = "%".str_replace(" ","%",$_GET["search"])."%";
                    $stmt = mysqli_prepare($connexion, $bd_get);
                    mysqli_stmt_bind_param($stmt, "ss",$search,$search);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);

                }else if(isset($_GET['id'])) {

                    $id =$_GET['id'];
                    $parents = getCategoryChilds($connexion,$_GET['id']);

                    $params = "(".implode(",", array_fill(0, count($parents), "?")).")";
                    $bd_get = "SELECT * FROM posts WHERE categoryid in ".$params." ORDER BY postid DESC limit 100";
                    $stmt = mysqli_prepare($connexion, $bd_get);

                    $types = str_repeat("i", count($parents));
                    $args = array_merge(array($stmt,$types), $parents);
                    ini_set('display_errors', '0');
                    call_user_func_array("mysqli_stmt_bind_param", $args);
                    ini_set('display_errors', '1');

                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    mysqli_stmt_close($stmt);  
                }else{
                    $bd_get = "SELECT * FROM posts ORDER BY postid DESC limit 100";
                    $result = mysqli_query($connexion, $bd_get) or die('erreur');
                }

                if(isset($_GET["search"]) && strlen($_GET["search"]) > 0 && isset($_GET["id"])){
                    echo "<div id='search'>Résultat de la recherche pour \"<span class='colored'>".$_GET["search"]."</span>\" <a href='index.php?id=".$_GET["id"]."' class='retour'>Annuler</a></div>";
                }else if(isset($_GET["search"]) && strlen($_GET["search"]) > 0){
                    echo "<div id='search'>Résultat de la recherche pour \"<span class='colored'>".$_GET["search"]."</span>\" <a href='index.php' class='retour'>Annuler</a></div>";
                }
                if(isset($_GET["id"])){
                    $category = getCategory($connexion,$_GET["id"]);
                    if($category){
                        if(isset($_GET["search"])) echo "<div id='category'>Résultat de la recherche dans la catégorie \"<span class='colored'>".$category["name"]."</span>\" <a href='index.php?search=".$_GET["search"]."' class='retour'>Annuler</a></div>";
                        else echo"<div id='category'>Résultat de la recherche dans la catégorie \"<span class='colored'>".$category["name"]."</span>\" <a href='index.php' class='retour'>Annuler</a></div>";
                    }
                }

                    while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)){    

                        $bd_get = "SELECT count(answerid) AS nbr FROM answers WHERE postid = ? and isgood = 1";
                        $stmt = mysqli_prepare($connexion, $bd_get);
                        mysqli_stmt_bind_param($stmt, "i", $ligne["postid"]);
                        mysqli_stmt_execute($stmt);
                        $answerResult = mysqli_stmt_get_result($stmt);
                        mysqli_stmt_close($stmt);

                        $answerResult = mysqli_fetch_array($answerResult, MYSQLI_ASSOC);
                        if($answerResult) $anwser = $answerResult["nbr"];

                        echo " <div class='index'>
                                <div class='arbo'>" .getCategoryArbo($connexion, $ligne["categoryid"]). "</div>
                                <h3>" .$ligne['title']. "</h3>";
                        if(strlen($ligne["text"])>=200){
                            echo "<p>" .substr($ligne['text'],0,200). "...</p>";
                        }else{
                            echo "<p>" .$ligne['text']. "</p>";
                        }
                        echo "
                            <div class='index_bottom'>
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
            <sidebar>
                <div id="category_title"></div>
                    <?php
                        include 'data/db_login.php';

                        $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
                        $catlist = getCatList($connexion);
                        
                        $catFollowed = [];
                        if(isset($_SESSION["connected"])){
                            $bd_get = "SELECT categoryid FROM follow WHERE userid = ?";
                            $stmt = mysqli_prepare($connexion, $bd_get);
                            mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);
                            mysqli_stmt_close($stmt);

                            while($ligne = mysqli_fetch_array($result, MYSQLI_ASSOC)) array_push($catFollowed,$ligne['categoryid']);
                        }

                        foreach($catlist as $cat){
                            if(isset($_GET["id"]) && $_GET["id"] == $cat[0]){
                                echo"<div class='category' id='selected_cat'>";
                                for($i=0;$i<$cat[2];$i++){
                                    echo"&#160;&#160;&#160;";
                                }
                                echo $cat[1];
                                echo "<div class='ligne invisible'></div>";
                                echo"<span class='category_button'>";
                                
                                if(in_array($cat[0],$catFollowed)) 
                                echo "<a href='actions/follow.php?follow=false&id=".$cat[0]."&url=".$_SERVER['REQUEST_URI']."'>
                                    <img class='category_img_button invisible' src='data/img/icon_delete_highlight.png' title='Ne plus suivre'/>";
                                else 
                                echo "<a href='actions/follow.php?follow=true&id=".$cat[0]."&url=".$_SERVER['REQUEST_URI']."'>
                                    <img class='category_img_button invisible' src='data/img/icon_add_highlight.png' title='Suivre'/>";

                                echo"</a></span></div>";
                            }else{
                                echo"<div class='category' id='".$cat[0]."'>";
                                if(isset($_GET["search"])){
                                    echo "<a href='index.php?search=".$_GET["search"]."&id=".$cat[0]."'>";
                                }else{
                                    echo "<a href='index.php?id=".$cat[0]."'>";
                                }
                                for($i=0;$i<$cat[2];$i++){
                                    echo"&#160;&#160;&#160;";
                                }
                                echo $cat[1]."</a>";
                                echo "<div class='ligne invisible'></div>";
                                echo"<span class='category_button'><a href='actions/follow.php?follow=true&id=".$cat[0]."&url=".$_SERVER['REQUEST_URI']."'>";

                                if(in_array($cat[0],$catFollowed)) 
                                echo "<a href='actions/follow.php?follow=false&id=".$cat[0]."&url=".$_SERVER['REQUEST_URI']."'>
                                    <img class='category_img_button invisible' src='data/img/icon_delete_normal.png' title='Ne plus suivre'/>";
                                else 
                                echo "<a href='actions/follow.php?follow=true&id=".$cat[0]."&url=".$_SERVER['REQUEST_URI']."'>
                                    <img class='category_img_button invisible' src='data/img/icon_add_normal.png' title='Suivre'/>";

                                echo"</a></span></div>";
                            }
                        }
                    ?>  
        </div>
        <footer>
            <?php include 'data/footer.php';?>
        </footer>
    </body>
</html>
