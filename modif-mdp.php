<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <title>Modifier votre mot de passe - ForHelp</title>
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
            if($_GET["error"] == "dontmatch") {
              echo "<p style='color:red;'>La confirmation ne correspond pas au nouveau mot de passe</p>";
            }
            else if ($_GET["error"] == "mauvaisold") {
              echo "<p style='color:red;'>Mauvais ancien mot de passe</p>";
            }
          }
        ?>
        <table>
          <form action='actions/modif-mdp-action.php' method='post'>
              <tr>
                <td>
                  <label> Ancien mot de passe :</label>
                </td>
                <td>
                  <input type="text" name='oldpass' required>
                </td>
              </tr><tr>
                <td>
                  <label> Nouveau mot de passe :</label>
                </td>
                <td>
                  <input type="password" name='newpass' required>
                </td>
              </tr><tr>
                <td>
                  <label> Confirmez mot de passe :</label>
                </td>
                <td>
                  <input type="password" name='cnewpass' required>
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
