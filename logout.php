<?php
    session_start();
    if (isset($_POST['deconnexion']) && $_POST['deconnexion']=="logout"){
        session_destroy();
        unset($_SESSION['connected']);
        $_SESSION['connected']= NULL;
        header('Location: connection.php?id=logout');
    }
    else {
        $_SESSION['connected']= NULL;
        header('Location: index.php');
    }
?>