<?php
    require "../data/db_login.php";
    require "../data/functions.php";

    if(isset($_POST['mail'],$_POST['mdp'])){

        $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

        $req="SELECT userid from users where email = ? and password = ?";

        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "ss", $_POST['mail'], md5(htmlspecialchars($_POST['mdp'])));
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        foreach ($result as $ligne) $cat = $ligne;
        if (isset($cat)){
            if(session_status() != PHP_SESSION_ACTIVE){
                session_start();
            }
            $_SESSION['connected'] = $cat["userid"];
            header('Location: ../flux.php');
            exit(0);
        }
        else {
            header('Location: ../connection.php?id=pwd-mail_error');
        }
        mysqli_stmt_close($stmt);
    }
    else {
        header('Location: ../connection.php');
    }
?>
