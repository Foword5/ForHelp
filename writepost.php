<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Nouvelle demande - Forum d'entraide</title>
        <link href="styles/style.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'navbar.php'; ?>

        <div class="box">
            <form action="newanswer.php" method="POST" class="post-form">
                <input type="text" class="proposition-input" placeholder="nom du post" name="nom" required="">
                <br />
                <textarea class="proposition-textarea" placeholder="description de la question" name="description" required=""></textarea>
                <br />
                <select class="inscription-select" name="grpp" required="">
                    <option disabled="" selected="">Catégorie</option>
                    <option disabled="">-----------------------------</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option disabled="">-----------------------------</option>
                </select>
                <button type="submit" class="proposition-bouton" name="submit">Poster</button>
            </form>
        </div>

    </body>
</html>