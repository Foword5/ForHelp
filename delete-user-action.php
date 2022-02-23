<?php
      include "data/db_login.php";
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

        if ($data_pass == $password){
            $delete_req = "DELETE FROM users WHERE userid = ?";
            $stmt = mysqli_prepare($connexion, $delete_req);
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            
            header('Location: inscription.php?succes=deletesucces');
            mysqli_stmt_close($stmt);
        }

        else {
            header('Location: delete-user.php?error=mauvais');
        }
      }
?>
