<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Inscription - Forhelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
        <link href="styles/inscription.css" rel="stylesheet"/>
        <link rel="icon" type="image/png" href="data/img/logo.png" />
    </head>
    <body>
        <?php include "data/navbar.php";?>
        <div class="page"><main>
            <h1>Inscription</h1>
            <?php
                if (isset($_GET['succes'])) {
                    if ($_GET["succes"] == "deletesucces") {
                        echo "<p style='color:green;'>Compte supprimé avec succès</p>";
                    }
                }

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
                    }else if($_GET["error"] == "nocaptcha"){
                        echo "<p style='color:red;'>Erreur avec le captcha</p>";
                    }
                }
            ?>
            <table role="presentation">
                <form action="actions/inscriptionaction.php" method="POST"  autocomplete="off">
                    <tr>
                        <td>
                            <label for="inscr_form_username"> Nom d'utilisateur </label>
                        </td>
                        <td>
                            <input id="inscr_form_username" type="text" name="username" required title="4 caractères minimum"/>
                        </td>
                    </tr><tr>
                        <td>
                            <label for="inscr_form_mail">Adresse mail</label>
                        </td>
                        <td>
                            <input id="inscr_form_mail" type="email" name="mail" required />
                        </td>
                    </tr><tr id="mdp">
                        <td>
                            <label for="inscr_form_passwd">Mot de passe</label>
                        </td>
                        <td>
                            <input id="inscr_form_passwd" type="password" name="password" required title="5 caractères minimum"/>
                        </td>
                    </tr><tr>
                        <td>
                            <label for="inscr_form_pwd_confirm">Confirmer le mot de passe</label>
                        </td>
                        <td>
                            <input id="inscr_form_pwd_confirm" type="password" name="password_confirm" required />
                        </td>
                    </tr><tr>
                        <input type="hidden" id="recaptchaResponse" name="recaptcha-response">
                        <td colspan="2" id="submit">
                            <input type="submit" name="enter" value="S'inscrire">
                        </td>
                    </tr>
                </form>
            </table>
        </main></div>
        <footer>
            <?php include 'data/footer.php';?>
        </footer>
        <script src="https://www.google.com/recaptcha/api.js?render=6LewrdkeAAAAAFl4ZTmyaHgNuT0dwvNGCmrUvfsi"></script>
        <script>
            grecaptcha.ready(function() {
                grecaptcha.execute('6LewrdkeAAAAAFl4ZTmyaHgNuT0dwvNGCmrUvfsi', {action: 'homepage'}).then(function(token) {
                    document.getElementById('recaptchaResponse').value = token
                });
            });
        </script>
    </body>
</html>