<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier votre email - ForHelp</title>
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
      if($_GET["error"] == "dontmatch") {
        echo "<p style='color:red;'>La confirmation ne correspond pas au nouveau mail</p>";
      }
  }
    
?>

<table>
    <form action="modif-mail-action.php" method="post">
            <tr>
            <td>
              <label> Mot de passe :</label>
            </td>
            <td>
              <input type="password" name='password'>
            </td>
            </tr><tr>
            <td>
                <label>Nouveau mail :</label>
            </td>
            <td>
                <input type="text" name="newmail">
            </td>
            </tr><tr>
            <td>
                <label>Confirmez votre email :</label>
            </td>
            <td>
                <input type="text" name="cnewmail">
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

