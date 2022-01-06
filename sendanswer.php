<?php
    if(isset($_POST["post"]) && isset($_GET["post"])){
        require "data/db_login.php";
        include 'session_check.php';

        foreach ($_POST as $k => $v) $$k = htmlspecialchars($v);

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        $post = htmlspecialchars($_GET["post"]);

        $connexion=mysqli_connect($host,$login,$mdp,$bdd)
        or die("connexion impossible");

        $req="INSERT INTO answers(text,postid,userid) VALUES (?,?,?)";

        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "sii",$text,$post,$_SESSION["connected"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header('Location: post.php?post='.$post);
?>