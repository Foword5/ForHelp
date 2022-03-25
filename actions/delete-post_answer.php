<?php
    include "../data/db_login.php";
    if(isset($_GET["url"])){
        if(isset($_GET["post"])){
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

            $bd_get = "SELECT userid FROM posts WHERE postid = ?";
            $stmt = mysqli_prepare($connexion, $bd_get);
            mysqli_stmt_bind_param($stmt, "i", $_GET["post"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if(mysqli_num_rows($result) == 0){
                header("Location: ../index.php");
            }

            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
            $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if($result["userid"] == $_SESSION["connected"]){
                $delete_req = "DELETE FROM posts WHERE postid = ?";
                $stmt = mysqli_prepare($connexion, $delete_req);
                mysqli_stmt_bind_param($stmt, "i", $_GET["post"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
            header("Location: ../index.php");
        }else if(isset($_GET["answer"])){
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

            $bd_get = "SELECT userid FROM answers WHERE answerid = ?";
            $stmt = mysqli_prepare($connexion, $bd_get);
            mysqli_stmt_bind_param($stmt, "i", $_GET["answer"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);

            if(mysqli_num_rows($result) == 0) header("Location: ".$_GET["url"]);
            else $result = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
            if($result["userid"] == $_SESSION["connected"]){
                $delete_req = "DELETE FROM answers WHERE answerid = ?";
                $stmt = mysqli_prepare($connexion, $delete_req);
                mysqli_stmt_bind_param($stmt, "i", $_GET["answer"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
            }
            header("Location: ".$_GET["url"]);
        }else{
            header("Location: ".$_GET["url"]);
        }
    }else{
        header("Location: ../index.php");
    }
?>