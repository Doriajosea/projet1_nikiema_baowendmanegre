<a href="../">Accueil</a>
<h2>Login result</h2>
<?php

require_once '../functions/userCrud.php';
require_once '../functions/validation.php';
// require_once '../utils/connexion.php';

var_dump($_POST);

//Authentification

if (isset($_POST)) {

    //vérifier si username dans DB
    if (!empty($_POST['user_name'])) {
       // $userData = getUserByUsername($_POST['user_name']);
    } else {
        //Erreur rien entré
        //redirect vers login
        $url = '../affichage/login.php';
        header('Location: ' . $url);
    }

    
    //si l'utilisateur exist dans la DB
    if ($userData) {
        // comparer pwd avec DB (version encodée)
       // $enteredPwdEncoded = encodePwd($_POST['pwd']);
        if ($userData['pwd'] == $enteredPwdEncoded) {
            //traitement si mdp correct
            //créeer un token
            $token = hash('sha256', random_bytes(32));
            echo '</br></br>Mon token : </br>';
            
            var_dump($token);
            //enregistrer le token en Session et dans la DB

            echo "C'est le bon mdp ";
        }else {
            //traitement si mdp incorrect
            //compter lenombre d'erreur et bloquer l'IP apres 3 erreur
            //Les erreurs peuvent etre dans une Session
            //Proposer de réinitialiser le mdp
            //Créer un msg d'erreur
            //renvoyer sur la page login
            echo "C'est pas le bon mdp ";        }
    }
} else {
    //redirect vers login
    $url = '../index.php';
    header('Location: ' . $url);
}










?>