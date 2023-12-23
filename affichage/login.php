<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../style.css">
        <title>Formulaire de Connection</title>
        
    </head>
    <body>

        <?php
            session_start(); // Start the session
            if (isset($_SESSION['user_logged_in']) ) {
                // Redirect au home quand user est deja connecter
               if( $_SESSION['user_logged_in'] == true){
                $url = '../index.php';
                header('Location: ' . $url);
               }
            }

            
            if (isset($_SESSION["error_message"])) {
                echo "<p class='error-message'>{$_SESSION["error_message"]}</p>";
                unset($_SESSION["error_message"]);
            }

            $user_name = '';
            if (isset($_SESSION['signup_form']['user_name'])) {
            $user_name = $_SESSION['signup_form']['user_name'];
            }

            
            $pwd = '';
            if (isset($_SESSION['signup_form']['pwd'])) {
                $pwd = $_SESSION['signup_form']['pwd'];
            }

            require_once '../functions/userCrud.php';
            require_once '../functions/validation.php';
            require_once '../conn/connexion.php';
            require_once '../functions/encode.php';

        ?>

        <h1>Hello vous devez vous connecter</h1>


        <form method="post" action="../valide/loginValid.php">


            <div>
                <label for="user_name">Nom d'utilisateur</label>
                <input id="user_name" type="text" name="user_name" value="<?php echo $user_name ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['user_name'])? $_SESSION['signup_errors']['user_name'] : '' ?></p>
            </div>

            <div>
                <label for="pwd">Mot de passe : </label>
                <input id="pwd" type="password" name="pwd" value="<?php echo $pwd ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['pwd'])? $_SESSION['signup_errors']['pwd'] : '' ?></p>
            
            </div>

            <button type="submit">Me connecter</button>

        </form>

        </body>
</html>