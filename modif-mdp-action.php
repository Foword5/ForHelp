<?php
if(isset($_POST["connected"])){

    if(isset($_SESSION["userid"]) && isset($_SESSION["username"]) ){
        include "data/db_login.php";
        $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

        if (isset($_POST['oldpass']) && 
            isset($_POST['newpass']) &&
            isset($_POST['cnewpass'])){
                
                function valider($data){
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                $oldpass = valider($_POST['oldpass']);
                $newpass = valider($_POST['newpass']);
                $cnewpass = valider($_POST['cnewpass']);

                if (empty($oldpass)){
                    header("Location: modif-mdp.php?error=Manque ancien mdp");
                }
                elseif (empty($newpass)){
                    header("Location: modif-mdp.php?error=Manque nouveau mdp");
                }
                elseif ($newpass !== $cnewpass){
                    header("Location: modif-mdp.php?error=dont match");
                }
                else{
                    $userid = $_SESSION['userid'];

                    $req = "SELECT password FROM users WHERE userid='$userid' AND password = '$oldpass'";
                    $res = mysqli_query($connexion, $req);

                    if (mysqli_num_rows($res) === 1){
                        $req2 = "UPDATE users SET password = '$newpass' WHERE userid = '$userid'";
                        mysqli_query($connexion, $req2);
                        header("Location: modif-mdp.php?success=matched");
                        exit();
                    }
                    else {
                        header("Location: modif-mdp.php?error=mauvais pass");
                        exit();
                    }
                }
            }
            else {
                header("Location: modif-mdp.php");
                exit();
            }
    }else{
        header('Location: index.php');
    }
}



  