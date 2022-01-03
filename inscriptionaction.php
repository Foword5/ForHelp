<?php
    if(isset($_POST["enter"])){
        if(isset($_POST["username"]) && isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["password_confirm"])){
            foreach($_POST as $k => $v) $$k = htmlspecialchars($v);
            if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                header('Location: inscription.php?error=notemail');
                exit(0);
            }
            if(strlen($username) < 4){
                header('Location: inscription.php?error=usrnmtoosmall');
                exit(0);
            }
            if($password !== $password_confirm){
                header('Location: inscription.php?error=psswdnotsame');
                exit(0);
            }
            if(strlen($password) < 5){
                header('Location: inscription.php?error=psswdtoosmall');
                exit(0);
            }

            include "data/db_login.php";

            $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

            $req="SELECT * from users where email = ?";

            $stmt = mysqli_prepare($connexion, $req);
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            foreach($result as $ligne) $cat = $ligne;

            if(isset($cat)){
                header('Location: inscription.php?error=emailexist');
                exit(0);
            }

            $req="INSERT INTO users(username,email,password) VALUES (?,?,?)";

            $stmt = mysqli_prepare($connexion, $req);
            mysqli_stmt_bind_param($stmt, "sss",$username, $mail, $password);
            mysqli_stmt_execute($stmt);

            mysqli_close($connexion);

        }
    }
    header('Location: index.php');
?>