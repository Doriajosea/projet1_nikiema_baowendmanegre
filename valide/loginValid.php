<a href="../">Accueil</a>
<h2>Login result</h2>
<?php

require_once '../functions/userCrud.php';
require_once '../functions/validation.php';
require_once '../conn/connexion.php';
require_once '../functions/encode.php';



var_dump($_POST);

//Authentification


// Nom d'utilisateur à vérifier
$user_name_verif = "le_nom_utilisateur_que_vous_voulez_verifier";


$sql = "SELECT * FROM user WHERE user_name = '$user_name_verif'";
$result = mysqli_query($conn, $sql);

// Vérifier si la requête a renvoyé des résultats
if (mysqli_num_rows($result) > 0) {
    // L'utilisateur existe dans la base de données
    echo "L'utilisateur existe.";
} else {
    // L'utilisateur n'existe pas dans la base de données
    echo "L'utilisateur n'existe pas.";
}


if (isset($_POST)) {

    //vérifier si username dans DB
    if (!empty($_POST['user_name'])) {
       $userData = getUserByUsername($_POST['user_name']);
    } else {
        
        $url = '../affichage/login.php';
        header('Location: ' . $url);
    }

    
    //si l'utilisateur exist dans la DB
    if ($userData) {
        
       $enteredPwdEncoded = encodePwd($_POST['pwd']);
       $data =[
        'id'=>$userData['id'],
        'token'=>$token
       ];
       $ajouterToken = changeToken($data);
        if ($userData['pwd'] == $enteredPwdEncoded) {
            $_SESSION['auth']=[
                'id'=>$userData['id'],
                'role_id'=>$userData['role_id'],
                'token'=>$token
            ];

            $token = hash('sha256', random_bytes(32));
            echo '</br></br>Mon token : </br>';
            
            var_dump($token);
            //enregistrer le token en Session et dans la DB

            echo "C'est le bon mdp ";
        }else {
            echo "C'est pas le bon mdp ";        }
    }
} else {
    //redirige vers login
    $url = '../index.php';
    header('Location: ' . $url);
}










?>