<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supprimer votre compte - ForHelp</title>
    <link href="styles/style.css" rel="stylesheet"/>
    <link href="styles/modifinfo.css" rel="stylesheet"/>
</head>
<body>
    <?php
    include "data/navbar.php";

    if (isset($_GET['error'])){
        if ($_GET["error"] == "mauvais"){
            echo "<p style='color:red;'>Mauvais mot de passe</p>";
        }
    }
    ?>

    <table>
        <form action="delete-user-action.php" method="post">
            <tr>
                <td>
                    <label>Votre mot de passe :</label>
                </td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr><tr>
                <td>
                    <a href='account.php?user=me'>Retournez</a>
                </td>
                <td colspan="2" id="submit">
                    <input type="submit" name="enter" value="Supprimer">
                </td>
            </tr>
        </form>
    </table>
</body>
</html>