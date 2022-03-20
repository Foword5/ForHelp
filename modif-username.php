<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Modifier votre username - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/modifinfo.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="data/img/logo.png" />
    </head>
    <body>
        <?php
            include "data/navbar.php";
            include "session_check.php";
        ?>
        <div class="page"><main>
            <?php
                if (isset($_GET['error'])){
                    if ($_GET["error"] == "mauvaispass") {
                    echo "<p style='color:red;'>Mauvais mot de passe</p>";
                    }
                }
            ?>
            <table>
                <form action='actions/modif-username-action.php' method="post">
                        <tr>
                        <td>
                        <label> Mot de passe :</label>
                        </td>
                        <td>
                        <input type="password" name='password' required>
                        </td>
                        </tr><tr>
                        <td>
                            <label>Nouveau nom d'utilisateur :</label>
                        </td>
                        <td>
                            <input type="text" name="newusername" required>
                        </td>
                        </tr><tr>
                        <td>
                            <a href='account.php?user=<?php echo $_SESSION["connected"]?>' class='link'>Revenir</a>
                        </td>
                        <td colspan="2" id="submit">
                            <input type="submit" name="enter" value="Modifier">
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
