<?php
    if(isset($_POST["post"])){
        require "../data/db_login.php";
        include '../session_check.php';

        $connexion=mysqli_connect($host,$login,$mdp,$bdd)
        or die("connexion impossible");

        foreach ($_POST as $k => $v) $$k = htmlspecialchars($v);

        $req="SELECT * from categories where categoryid = ?";

        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $categoryid);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        foreach($result as $verif);

        if(!$verif){
            header('Location: ../writepost.php?error=cat');
            exit(0);
        }

        $req="INSERT INTO posts(title,text,categoryid,userid) VALUES (?,?,?,?)";

        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "ssii",$title,$text,$categoryid,$_SESSION["connected"]);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../index.php');
        exit(0);
    }
    header('Location: ../writepost.php');
?>