<?php
session_start();
if (isset($_POST['deconnexion']) && $_POST['deconnexion']=="logout"){
    session_destroy();
    unset($_SESSION['connected']);
    $_SESSION['connected']= NULL;
    header('Location: connexion.php?id=logout');
}
else {
    header('Location: connexion.php?id=connexion_error');
}
?>