<a href="../">Accueil</a>
<?php

require_once '../functions/validation.php';
require_once '../functions/userCrud.php';
require_once '../conn/connexion.php';
require_once '../functions/encode.php';

session_start();

// Todo : valider les données de mon form 
// si les données ne sont pas bonne : renvoyer vers le form d'enregistrement (redirect auto )
// attention on veut récupérer les données rentrées précédement : $_SESSION

var_dump($_POST);



if (isset($_POST)) {
    $_SESSION['signup_form'] = $_POST;

    unset($_SESSION['signup_errors']);



    $fieldValidation = true;
    // valid user name
    if (isset($_POST['user_name'])) {
        $nameIsValidData = usernameIsValid($_POST['user_name']);
        if ($nameIsValidData['isValid'] == false) {
            var_dump("Erruer dans username");
            $fieldValidation = false;
        }
    }

    //valid email
    if (isset($_POST['user_name'])) {
        $emailIsValidData = emailIsValid($_POST['email']);

        if ($emailIsValidData['isValid'] == false) {
            var_dump("Erruer dans email");

            $fieldValidation = false;
        }
    }
    // valid mdp
    if (isset($_POST['user_name'])) {
        $pwdIsValidData = pwdLenghtValidation($_POST['pwd']);

        if ($pwdIsValidData['isValid'] == false) {
            var_dump("Erruer dans pwd");

            $fieldValidation = false;
        }
    }

    if ($fieldValidation == true) {
        //envoyer à la DB

        $encodedPwd = encodePwd($_POST['pwd']);
        $data = [
            'user_name' => $_POST['user_name'],
            'email' => $_POST['email'],
            'pwd' => $encodedPwd
        ];
        //$newUser = createUser($data);
    } else {
        // redirect to signup et donner les messages d'erreur
        $_SESSION['signup_errors'] = [
            'user_name' => $nameIsValidData['msg'],
            'email' => $emailIsValidData['msg'],
            'pwd' => $pwdIsValidData['msg']
        ];
        $url = '../affichage/signup.php';
        header('Location: ' . $url);
    }
} else {
    //redirect vers signup
    $url = '../affichage/signup.php';
    header('Location: ' . $url);
}
