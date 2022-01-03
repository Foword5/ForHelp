<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inscription - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/inscription.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include "data/navbar.php";?>
        <main>
            <?php
                if(isset($_GET["error"])){
                    if($_GET["error"] == "notemail"){
                        echo "<p style='color:red;'>Veuillez entrer une adresse email valide</p>";
                    }else if($_GET["error"] == "usrnmtoosmall"){
                        echo "<p style='color:red;'>Votre nom d'utilisateur doit faire 4 caractères minimum</p>";
                    }else if($_GET["error"] == "psswdnotsame"){
                        echo "<p style='color:red;'>Les deux mots de passe ne corresponde pas</p>";
                    }else if($_GET["error"] == "psswdtoosmall"){
                        echo "<p style='color:red;'>Votre mot de passe doit faire 5 caractères minimum</p>";
                    }else if($_GET["error"] == "emailexist"){
                        echo "<p style='color:red;'>L'adresse email est déjà enregistré</p>";
                    }
                }
            ?>
            <table>
                <form action="inscriptionaction.php" method="POST"  autocomplete="off">
                    <tr>
                        <td>
                            <label> Nom d'utilisateur </label>
                        </td>
                        <td>
                            <input type="text" name="username" required />
                        </td>
                    </tr><tr>
                        <td>
                            <label>Adresse mail</label>
                        </td>
                        <td>
                            <input type="email" name="mail" required />
                        </td>
                    </tr><tr id="mdp">
                        <td>
                            <label>Mot de passe</label>
                        </td>
                        <td>
                            <input type="password" name="password" required />
                        </td>
                    </tr><tr>
                        <td>
                            <label>Confirmer le mot de passe</label>
                        </td>
                        <td>
                            <input type="password" name="password_confirm" required />
                        </td>
                    </tr><tr>
                        <td colspan="2" id="submit">
                            <input type="submit" name="enter" value="s'inscrire">
                        </td>
                    </tr>
                </form>
            </table>
        </main>
    </body>
</html>