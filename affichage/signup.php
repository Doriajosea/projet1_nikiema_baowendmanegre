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
            $fname = '';
            if (isset($_SESSION['signup_form']['fname'])) {
                $fname = $_SESSION['signup_form']['fname'];
            }
            $lname = '';
            if (isset($_SESSION['signup_form']['lname'])) {
                $lname = $_SESSION['signup_form']['lname'];
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
                <input id="pwd" type="password" name="pwd" value="<?php echo $pwd ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['pwd'])? $_SESSION['signup_errors']['pwd'] : '' ?></p>
            
            </div>

            <div>
                    <label for="fname">Prenom : </label>
                    <input id="fname" type="text" name="fname" value="<?php echo $fname ?>">
                    <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['fname'])? $_SESSION['signup_errors']['fname'] : '' ?></p>

            </div>

            <div>
                <label for="lname">Nom : </label>
                <input id="lname" type="text" name="lname" value="<?php echo $lname ?>">
                <p style="color: red; font-size: 0.8rem;"><?php echo isset($_SESSION['signup_errors']['lname'])? $_SESSION['signup_errors']['lname'] : '' ?></p>

            </div>

            
            
            <button type="submit">Soumettre mon enregistrement</button>
        </form>

    </body>
</html>