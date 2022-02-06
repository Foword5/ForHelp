<?php
    include "data/db_login.php";
    $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
    if(session_status() != PHP_SESSION_ACTIVE){
        session_start();
    }

    if (isset($_POST['cnewusername'])){

        $oldusername = $_POST['oldusername'];
        $newusername = $_POST['newusername'];
        $cnewusername = $_POST['cnewusername'];

        $req = "SELECT * FROM users WHERE userid = ?";
        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);// le type de ce que tu met (i pour int), puis la variable a associer
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);//tu obtiens une liste de liste
        mysqli_stmt_close($stmt);

        $req_fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data_username = $req_fetch['username'];

        if ($data_username == $oldusername){
            if ($newusername == $cnewusername) {
                $update_req = "UPDATE users SET username = '$newusername' WHERE userid=?";
                $stmt = mysqli_prepare($connexion, $update_req);
                mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);// le type de ce que tu met (i pour int), puis la variable a associer
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);//tu obtiens une liste de liste
                mysqli_stmt_close($stmt);
    
            header('Location: index.php?succes=usernamesucces');
            }

            else {
                header('Location : modif-username.php?error=dontmatch');
            }      
        }   

        else {
            header('Location: modif-username.php?error=mauvaisold');
        }
    }
    

?>