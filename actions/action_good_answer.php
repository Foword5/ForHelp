<?php
    include "../data/db_login.php";
    if(isset($_GET["url"])){
        if(isset($_GET["answer"]) && isset($_GET["good"])){
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

            $bd_get = "SELECT userid FROM posts WHERE postid IN (SELECT postid FROM answers WHERE answerid = ?)";
            $stmt = mysqli_prepare($connexion, $bd_get);
            mysqli_stmt_bind_param($stmt, "i", $_GET["answer"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if(mysqli_num_rows($result) == 0){
                header("Location: ".$_GET["url"]);
            }

            if(session_status() != PHP_SESSION_ACTIVE) session_start();

            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($result["userid"] == $_SESSION["connected"]){
                $bd_get = "SELECT userid FROM answers WHERE answerid = ?";
                $stmt = mysqli_prepare($connexion, $bd_get);
                mysqli_stmt_bind_param($stmt, "i", $_GET["answer"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);

                if(mysqli_num_rows($result) == 0){
                    header("Location: ".$_GET["url"]);
                }
                
                if($_GET["good"] == "true"){
                    $setgood = "UPDATE answers SET isgood = 1 WHERE answerid = ?";
                    $addpoint = "UPDATE users SET points = points+1 WHERE userid = ?";
                }else if($_GET["good"] == "false"){
                    $setgood = "UPDATE answers SET isgood = 0 WHERE answerid = ?";
                    $addpoint = "UPDATE users SET points = points-1 WHERE userid = ?";
                }else{
                    $setgood = "SELECT userid FROM answers WHERE answerid = ?";
                    $addpoint = "SELECT userid FROM answers WHERE answerid = ?";
                }
                $stmt = mysqli_prepare($connexion, $setgood);
                mysqli_stmt_bind_param($stmt, "i", $_GET["answer"]);
                mysqli_stmt_execute($stmt);
                if($result["userid"] != $_SESSION["connected"]){
                    $stmt = mysqli_prepare($connexion, $addpoint);
                    mysqli_stmt_bind_param($stmt, "i", $result["userid"]);
                    mysqli_stmt_execute($stmt);
                }
            }
        }
        header("Location: ".$_GET["url"]);
    }else{
        header("Location: ../index.php");
    }
?>