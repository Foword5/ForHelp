<?php
    include "../data/db_login.php";
    $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if (isset($_POST['password'])){

        $password = $_POST['password'];
 

        $req = "SELECT * FROM users WHERE userid = ?";
        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        $req_fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data_pass = $req_fetch['password'];

        if ($data_pass == md5($password)){
            if (isset($_FILES["pfp"]) && ["image/png","image/jpeg","image/jpg"].include($_FILES["pfp"]["type"])) {

                $update_req = "UPDATE users SET profilepic = ? WHERE userid=?";
                $stmt = mysqli_prepare($connexion, $update_req);
                mysqli_stmt_bind_param($stmt, "si",file_get_contents($_FILES["pfp"]["tmp_name"]), $_SESSION["connected"]);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);

                header('Location: ../index.php?succes=pfpsucces');
            }else{
                header('Location: ../modif-pfp.php?error=noimg');
            }
        }else {
            header('Location: ../modif-pfp.php?error=mauvaispass');
        }
    }
    

?>