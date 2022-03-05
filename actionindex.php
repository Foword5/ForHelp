<?php

if(isset($_GET['id'])){

include 'data/functions.php';
include 'data/db_login.php';
include 'session_check.php';

$id=$_GET['id'];

$connexion=mysqli_connect($host,$login,$mdp,$bdd) or die("connexion impossible");

$req="SELECT * FROM follow WHERE categoryid=? AND userid=?";
$stmt = mysqli_prepare($connexion, $req);
mysqli_stmt_bind_param($stmt,"ii",$id,$_SESSION["connected"]);
$result2=mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

if($result2 == TRUE)
    {
    $req="INSERT INTO follow(categoryid,userid,notificationactivate) VALUES (?,?,'0')";
    $stmt = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($stmt, "ii",$id,$_SESSION["connected"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location:index.php?id=1');
    }

else
    {
    $req="DELETE FROM follow WHERE categoryid=? AND userid=?";
    $stmt = mysqli_prepare($connexion, $req);
    mysqli_stmt_bind_param($stmt, "ii",$id,$_SESSION["connected"]);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location:index.php?id=2');
    }
}

?>