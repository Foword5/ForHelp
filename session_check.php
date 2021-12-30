<?php
session_start();
require "data/db_login.php";
require "data/functions.php";


if(isset($_SESSION['connected'])){

    $connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

    $req="select userid from users where userid = ?";

    $stmt = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['connected']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    foreach ($result as $ligne) $cat = $ligne;
    if (isset($cat)){
        echo "<p>Bonjour <strong>".$_SESSION['connected']."</strong></p>";
        echo "<form action='logout.php' method='post'>
        <input type='submit' name='deconnexion' value='logout'>
        </form>";
        //Si l'utilisateur est connecté, le salut et affiche de bouton de deconnexion 
    }
    else{
        header('Location: connexion.php?id=connexion_error');
        exit(0);
    }
    
} 

else{
    header('Location: connexion.php?id=connexion_error');
    exit(0);
}
?>