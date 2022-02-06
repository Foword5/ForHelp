<?php
      include "data/db_login.php";
      $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");
      if(session_status() != PHP_SESSION_ACTIVE){
          session_start();
      }

      if (isset($_POST['newmail'])){

        $password = $_POST['password'];
        $newmail = $_POST['newmail'];

        $req = "SELECT * FROM users WHERE userid = ?";
        $stmt = mysqli_prepare($connexion, $req);
        mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);// le type de ce que tu met (i pour int), puis la variable a associer
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);//tu obtiens une liste de liste
        mysqli_stmt_close($stmt);

        $req_fetch = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $data_pass = $req_fetch['password'];

        if ($data_pass == $password){
            $update_req = "UPDATE users SET email = '$newmail' WHERE userid=?";
            $stmt = mysqli_prepare($connexion, $update_req);
            mysqli_stmt_bind_param($stmt, "i", $_SESSION["connected"]);// le type de ce que tu met (i pour int), puis la variable a associer
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);//tu obtiens une liste de liste
            mysqli_stmt_close($stmt);

            header('Location: index.php?succes=mailsucces');
          }
        }

        else {
          header('Location: modif-mdp.php?error=mauvaispass');
        }
 ?>
