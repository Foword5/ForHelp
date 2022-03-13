<?php
    if(isset($_GET["url"])){
        if(session_status() != PHP_SESSION_ACTIVE) session_start();
        if(isset($_GET["follow"]) && isset($_GET["id"]) && isset($_SESSION["connected"])){
            include "../data/db_login.php";
            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
            if($_GET["follow"] == "true"){
                $bd_update = "INSERT INTO follow VALUES (?,?,0)";
                $stmt = mysqli_prepare($connexion, $bd_update);
                mysqli_stmt_bind_param($stmt, "ii", $_GET["id"],$_SESSION["connected"]);
                mysqli_stmt_execute($stmt);
            }else{
                $bd_update = "DELETE FROM follow WHERE categoryid = ? AND userid = ?";
                $stmt = mysqli_prepare($connexion, $bd_update);
                mysqli_stmt_bind_param($stmt, "ii", $_GET["id"],$_SESSION["connected"]);
                mysqli_stmt_execute($stmt);
            }
            mysqli_stmt_close($stmt);
        }
        header("Location: ".$_GET["url"]);
    }else{
        header("Location: index.php");
    }
?>