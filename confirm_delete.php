<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Confirmer - ForHelp</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?php
            include "data/navbar.php";
        ?>
        <div class="page"><main>
            <?php
                if((!isset($_GET["post"]) && !isset($_GET["answer"])) || !isset($_GET["url"])){
                    header("Location : index.php");
                }
            ?>
            <div class="center">
                <h3>Êtes vous sûre ?</h3>
                <div>
                    <a href="<?php echo $_GET["url"] ?>"><button>Annuler</button></a>
                    <a href="actions/delete-post_answer.php?<?php 
                        if(isset($_GET["post"])){
                            echo "post=".$_GET["post"];
                        }else if(isset($_GET["answer"])){
                            echo "answer=".$_GET["answer"];
                        }
                        echo "&url=".$_GET["url"];
                    ?>"><button class='red_button'>Confirmer la suppression</button></a>
                </div>
            </div>
        </main></div>
        <footer>
            <?php include "data/footer.php"; ?>
        </footer> 
        <style>
            .center{
                text-align: center;
            }
        </style>
    </body>
</html>
