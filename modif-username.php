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
        if($_GET["error"] == "dontmatch") {
          echo "<p style='color:red;'>newusername dont match cnewusername</p>";
        }
        else if ($_GET["error"] == "mauvaisold") {
          echo "<p style='color:red;'>oldusername mauvais</p>";
        }
      }
?>

<table>
    <form>
            <tr>
                <td>
                    <label>Ancien nom d'utilisateur</label>
                </td>
                <td>
                    <input type="text" name="oldusername">
                </td>
            </tr><tr>
            <td>
                <label>Nouveau nom d'utilisateur</label>
            </td>
            <td>
                <input type="text" name="newusername">
            </td>
            </tr><tr>
            <td>
                <label>Nouveau nom d'utilisateur</label>
            </td>
            <td>
                <input type="text" name="cnewusername">
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
