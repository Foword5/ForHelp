<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Supprimer votre compte - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="data/img/logo.png" />
        <link href="styles/modifinfo.css" rel="stylesheet"/>
    </head>
    <body>
        <?php
            include "data/navbar.php";
            include "session_check.php";
        ?>
        <div class="page"><main>
            <?php
                if (isset($_GET['error'])){
                    if ($_GET["error"] == "mauvais"){
                        echo "<p style='color:red;'>Mauvais mot de passe</p>";
                    }
                }
            ?>
            <table>
                <form action="actions/delete-user-action.php" method="post">
                    <tr>
                        <td>
                            <label>Votre mot de passe :</label>
                        </td>
                        <td>
                            <input type="password" name="password" required>
                        </td>
                    </tr><tr>
                        <td>
                            <a href='account.php?user=<?php echo $_SESSION["connected"]?>' class='link'>Revenir</a>
                        </td>
                        <td colspan="2" id="submit">
                            <input type="submit" name="enter" value="Supprimer">
                        </td>
                    </tr>
                </form>
            </table>
        </main></div>
        <footer>
            <?php include "data/footer.php"; ?>
        </footer> 
    </body>
</html>