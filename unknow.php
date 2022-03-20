<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Page not found - Forehelp</title>
        <link rel="icon" type="image/png" href="data/img/logo.png" />
    </head>
    <body>
        <?php include "data/navbar.php";?>
        <div class="page">
            <main style="text-align: center;">
                <h1>404 - Page introuvable</h1>
            </main>
        </div>
        <footer>
            <?php include "data/footer.php";?>
        </footer>
        <style>
            @import url(http://fonts.googleapis.com/css?family=Roboto);

            body, textarea{
                font-family: 'Roboto', sans-serif;
                font-size: 20px;
            }

            main {
                width: 50%;
                margin: 10px auto 0 auto;
                padding: 15px;
                background-color: white;
            }

            body {
                background-color: #DDD;
                margin: 0;
            }

            button, input[type="submit"] {
                border-radius: 5px;
                height: 40px;
                font-size: 15px;
                background-color: #6667ab;
                color: white;
                border: 0;
                transition: 200ms;
                font-size: 20px;
                padding: 0 10px 0 10px;
            }

            button:hover, input[type="submit"]:hover {
                transform: scale(90%);
                transition: 200ms;
                cursor: pointer;
            }

            /* Style pour la NavBar */

            nav {
                background-color: white;
                padding: 15px calc(25% + 15px) 10px calc(25% - 15px);
                height: 30px;
                position: fixed;
                width: 100%;
                top: 0;
                z-index:1;
                display: flex;
            }

            #navseparator {
                background-color: #6667ab;
                width: 100%;
                height: 5px;
                top: 50px;
                position: fixed;
                z-index:1;
            }

            #blank_repos {
                height: 50px;
                width: 100%;
            }

            #nav_right {
                position: fixed;
                right: calc(25% - 15px);
            }

            #nav_disconnect {
                position: fixed;
                z-index:1;
                left: calc(75% + 30px);
            }

            #nav_right * {
                margin-left: 10px;
            }

            #nav_left * {
                margin-right: 10px;
            }

            nav a {
                text-decoration: none;
                color: black;
            }

            nav a:hover {
                text-decoration: underline;
                color: #6667ab;
                transition: 200ms;
            }

            /* le footer */

            footer{
                background: #6667ab;
                color: #fff;
                bottom: 0;
                width: 100%;
            }

            .content{
                display: flex;
                align-items: center;
                flex-direction: column;
                text-align: center;
                height: 150px;
            }

            .content h4{
                font-size: 1.8rem;
                font-weight: 400;
                text-transform: capitalize;
                margin-top: 5px;
                margin-bottom: 8px;
            }

            .content p{
                max-width: 500px;
                margin: 0.1px auto;
                margin-top: 4px;
                font-size: 14px;
            }

            .source{
                list-style: none;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-right: 33px;
                margin-bottom: 8px;

            }

            img {
                width: 40px;
                height: 40px;
            }
            .bottom{
                text-align: center;
                background: #48497a;
                padding: 1px 0;
                height: 50px;
            }

            .bottom p{
                font-size: 14px;
                word-spacing: 2px;
                text-transform: capitalize;
            }

            .page{
                min-height: calc(100vh - 262px);
            }

            .link{
                color: black;
                text-decoration: none;
            }

            .link:hover{
                text-decoration: underline;
            }

            .colored{
                color: #6667ab;
            }

            .highlight{
                font-weight: bold;
                text-decoration: underline;
                color: #6667ab;
            }
        </style>
    </body>
</html>