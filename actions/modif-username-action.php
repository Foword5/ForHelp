<?php
    include "../data/db_login.php";
    $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if (isset($_POST['password'])){

        $password = $_POST['password'];
        $newusername = $_POST['newusername'];
 

        $req = "SELECT * FROM users WHERE userid = ?";
        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        mysqli_stmt_close($stmt);

        $req_fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data_pass = $req_fetch['password'];

        if ($data_pass == md5($password)){
            
            $update_req = "UPDATE users SET username = ? WHERE userid=?";
            $stmt = mysqli_prepare($connexion, $update_req);
            mysqli_stmt_bind_param($stmt, "si",htmlspecialchars($newusername), $_SESSION["connected"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            
           header('Location: ../index.php?succes=usernamesucces');
        }   

        else {
            header('Location: ../modif-username.php?error=mauvaispass');
        }
    }
    

?>