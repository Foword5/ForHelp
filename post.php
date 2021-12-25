<!DOCTYPE html>
<html lang="fr">
    <?php
        if(isset($_GET["post"])){
            $postid=$_GET["post"];

            require "data/db_login.php";
            require "data/functions.php";

            $connexion=mysqli_connect($host,$login,$mdp,$bdd)
            or die("connexion impossible");

            $req="SELECT * from posts where postid = " . $postid;
            
            $result = mysqli_query($connexion,$req);

            if ($result) {
                if(mysqli_num_rows($result)>=1){
                    foreach($result as $ligne) $post = $ligne;
                    
                    echo getCategoryArbo($connexion,$post["categoryid"]);

                }else header("Location:unknow.html"); 
            }else header("Location:unknow.html");

            
        }else header("Location:unknow.html"); 
    ?>
    <head>
        <meta charset="UTF-8">
        <title>ForHelp - <?php echo $post["title"]; ?></title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        
    </body>
</html>