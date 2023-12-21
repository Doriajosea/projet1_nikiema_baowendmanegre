<a href="../">Accueil</a>
<?php
require_once "../functions/encode.php";
require_once "../functions/validation.php";
require_once "../conn/connexion.php";
require_once "../functions/userCrud.php";
session_start();
var_dump($_POST);

 
if (isset($_POST)) {
 
    $_SESSION["signup_form"] = $_POST;
 
    unset($_SESSION['signup_errors']);
 
    $fieldIsValid = true;
    if (isset($_POST["user_name"])) {
        $validUserName = userNameIsValid($_POST["user_name"]);
 
        if ($validUserName['isValid'] == false) {
            var_dump("Erruer dans username");
            $fieldIsValid = false;
            // die("je die dans mon valid UserName");
        }
    }
 
    if (isset($_POST["user_name"])) {
        $validEmail = emailIsValid($_POST["email"]);
 
        if ($validEmail['isValid'] == false) {
            $fieldIsValid = false;
            // die("je die dans mon valid Email");
        }
    }
 
    if (isset($_POST["user_name"])) {
        $validpwd = pwdLenghtValidation($_POST["pwd"]);
 
        if ($validpwd['isValid'] == false) {
            $fieldIsValid = false;
            //die("je die dans mon valid pwd");
        }
    }

    if (isset($_POST["user_name"])) {
        $validfnom = prenomIsValid($_POST["fname"]);
 
        if ($validfnom['isValid'] == false) {
            $fieldIsValid = false;
        }
    }
    if (isset($_POST["user_name"])) {
        $validprenom = nomIsValid($_POST["lname"]);
 
        if ($validprenom['isValid'] == false) {
            $fieldIsValid = false;
            // die("je die dans mon valid Lname");
        }
    }
 
    if ($fieldIsValid == true) {
        //envoyer à la DB
 
        $encodedPwd = encodePwd($_POST['pwd']);
 
        $data = [
            'user_name' => $_POST['user_name'],
            'email' => $_POST['email'],
            'pwd' => $encodedPwd,
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'billing_address_id' => 0,
            'shipping_address_id' => 0,
            'token' => "",
            'role_id' => 3
        ];
        var_dump($data);
        $token = hash('sha256', random_bytes(32));
        $_SESSION["session_token"] = $token;
        $newUser = createUser($data);
    } else {
        // redirect to signup and give errors message
        $_SESSION['signup_errors'] = [
            'user_name' => $validUserName['msg'],
            'email' => $validEmail['msg'],
            'pwd' => $validpwd['msg'],
            'fname' => $validfnom['msg'],
            'lname' => $validprenom['msg']
 
        ];
        $url = '../affichage/signup.php';
        header('Location: ' . $url);
    }
} else {
    //redirect to the  signup
    $url = '../affichage/signup.php';
    header('Location: ' . $url);
}
 
?>
<a href="../index.php">Return to the page Accueil</a>