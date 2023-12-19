[13:57] Diane Uwera
<?php
require_once "../functions/encode.php";
require_once "../functions/validation.php";
require_once "../conn/connexion.php";
require_once "../functions/userCrud.php";
session_start();
 
if (isset($_POST)) {
 
    $_SESSION["signup_form"] = $_POST;
 
    unset($_SESSION['signup_errors']);
 
    $fieldIsValid = true;
    if (isset($_POST["user_name"])) {
        $validUserName = userNameIsValid($_POST["user_name"]);
 
        if ($validUserName['isValid'] == false) {
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
        $validfnom = nomIsValid($_POST["nom"]);
 
        if ($validfname['isValid'] == false) {
            $fieldIsValid = false;
        }
    }
    if (isset($_POST["user_name"])) {
        $validprenom = prenomIsValid($_POST["prenom"]);
 
        if ($validlname['isValid'] == false) {
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
            'billing_address_id' => 1,
            'shipping_address_id' => 1,
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
            'fname' => $validfname['msg'],
            'lname' => $validlname['msg']
 
        ];
        $url = '../pages/signup.php';
        header('Location: ' . $url);
    }
} else {
    //redirect to the  signup
    $url = '../pages/signup.php';
    header('Location: ' . $url);
}
 
?>
<a href="../index.php">Return to the page Accueil</a>