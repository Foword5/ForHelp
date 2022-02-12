<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier le profil - Forum d'entraide</title>
    <link href="styles/style.css" rel="stylesheet"/>
    <link href="styles/modifinfo.css" rel="stylesheet"/>
</head>
<body>
<?php
    include "data/navbar.php";

    if (isset($_GET['error'])){
        if ($_GET["error"] == "mauvaispass") {
          echo "<p style='color:red;'>Mauvais mot de passe</p>";
        }
    }
?>

<table>
    <form action='modif-username-action.php' method="post">
            <tr>
            <td>
              <label> Mot de passe :</label>
            </td>
            <td>
              <input type="password" name='password'>
            </td>
            </tr><tr>
            <td>
                <label>Nouveau nom d'utilisateur :</label>
            </td>
            <td>
                <input type="text" name="newusername">
            </td>
            </tr><tr>
            <td>
                <a href='account.php?user=me'>Retournez</a>
            </td>
            <td colspan="2" id="submit">
                  <input type="submit" name="enter" value="Modifier">
            </td>
        </tr>
    </form>
</table>
</body>
</html>
