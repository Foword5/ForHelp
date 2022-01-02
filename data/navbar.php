<nav>
    <div id="nav_left">
        <a href="index.php">Rechercher</a>
        <a href="writepost.php">Poser une question</a>
    </div>

    <?php
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
        if(isset($_SESSION["connected"])){
            echo "<div id='nav_right'>
                    <a href='account.php?id=".$_SESSION["connected"]."'>Mon Compte</a>
                    <a href='flux.php'>Fil d'actualité</a>
                </div>
                <div id='nav_disconnect'>
                    <a href='logout.php'>Déconnexion</a>
                </div>";
        }else{
            echo "<div id='nav_right'>
                    <a href='connection.php'>Connexion</a>
                    <a href='inscription.php'>Inscription</a>
                </div>";
        }
    ?>
</nav>
<div id="navseparator"></div>
<div id="blank_repos"></div>