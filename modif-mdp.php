<?php
session_start();
if(isset($_SESSION["userid"]) && isset($_SESSION["username"]) ){

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le profil - Forum d'entraide</title>
    <link href="styles/style.css" rel="stylesheet"/>
    <link href="styles/account.css" rel="stylesheet"/>
</head>
<body>
<?php 
    include "data/navbar.php"; 
?>

<div class='container'>
    <form action='modif-mdp-action.php' method='post'>
        <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

       
        <input type="text" id='oldpass' placeholder='Ancien mot de passe'> 
        <br/>
        <input type="password" id='newpass' placeholder='Nouveau mot de passe'> 
        <br/>
        <input type="password" id='cnewpass' placeholder='Confirmez nouveau mot de passe'> 
        <br/>
        <button type='submit'>Modifier votre profil</button>
        <a href='account.php?user=me'>Retournez</a>

    </form>
</body>
</html>

<?php 
} else{
     header("Location: index.php");
     exit();
}
 ?>