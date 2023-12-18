<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulaire d'Adresse</title>
        <link rel="stylesheet" href="../style.css">
    </head>
    <body>
        
    
            <h1>Hello vous devez vous enregistrer</h1>


        <?php
            session_start();
            //var_dump($_SESSION);

            $nom = '';
            if (isset($_SESSION['signup_form']['nom'])) {
                $nom = $_SESSION['signup_form']['nom'];
            }

            $prenom = '';
            if (isset($_SESSION['signup_form']['prenom'])) {
                $prenom = $_SESSION['signup_form']['prenom'];
            }

            $user_name = '';
            if (isset($_SESSION['signup_form']['user_name'])) {
                $user_name = $_SESSION['signup_form']['user_name'];
            }

            $email = '';
            if (isset($_SESSION['signup_form']['email'])) {
                $email = $_SESSION['signup_form']['email'];
            }

            $pwd = '';
            if (isset($_SESSION['signup_form']['pwd'])) {
                $pwd = $_SESSION['signup_form']['pwd'];
            }


            if(isset($_POST['submit'])) {
            $nom = mysqli_real_escape_string($conn, $_POST['nom']);
            $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
            $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $pwd = md5($_POST['name']);

                $select = "SELECT * FROM user where userName = '$user_name' && email = '$email'&& pwd = '$pwd'" ;

                $result = mysqli_query($conn, $select);

                if(mysqli_num_rows($result) > 0) {
                    $error[] = 'user already exist!';
                }

            };
        
        ?>


        <!-- Chaque formulaire a sa page de résultats -->
        <!-- Todo : changer les types pour validation front -->
        <form method="post" action="../valide/signupValid.php">


            <div>
                <label for="nom">Nom : </label>
                <input id="nom" type="text" name="nom" value="<?php echo $nom ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['email'])? $_SESSION['signup_errors']['email'] : '' ?></p>

            </div>

            <div>
                <label for="prenom">Prenom : </label>
                <input id="prenom" type="text" name="prenom" value="<?php echo $prenom ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['prenom'])? $_SESSION['signup_errors']['prenom'] : '' ?></p>

            </div>

            <div>
                <label for="user_name">Nom d'utilisateur</label>
                <input id="user_name" type="text" name="user_name" value="<?php echo $user_name ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['user_name'])? $_SESSION['signup_errors']['user_name'] : '' ?></p>
            </div>

            <div>
            <label for="email">Courriel : </label>
            <input id="email" type="text" name="email" value="<?php echo $email ?>">
            <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['email'])? $_SESSION['signup_errors']['email'] : '' ?></p>

            </div>
            <div>
            <label for="pwd">Mot de passe : </label>
            <input id="pwd" type="text" name="pwd" value="<?php echo $pwd ?>">
            <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['pwd'])? $_SESSION['signup_errors']['pwd'] : '' ?></p>
        
            </div>
            
            
            <button type="submit">Soumettre mon enregistrement</button>
        </form>

    </body>
</html>