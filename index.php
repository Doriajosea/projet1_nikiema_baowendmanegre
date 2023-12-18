<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire d'Adresse</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <form method="post" action="">

            <div class="container">
            <h1><center>BIENVENUE</center></h1>

                <a href="./affichage/signup.php">Enregistrez-vous :) </a> </br> </br>
                <a href="./affichage/login.php">Connectez-vous :)</a>

                <?php
                session_start();
                //var_dump($_SESSION);
                ?>
            </div>
        </form>
    </body>
</html>