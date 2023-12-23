<a href="../">Accueil</a>
<h2>Login result</h2>
<?php

require_once '../functions/userCrud.php';
require_once '../functions/validation.php';
require_once '../conn/connexion.php';
require_once '../functions/encode.php';



session_start();



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

    $token = hash('sha256', random_bytes(32));
    
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





// session_start();

// // Vérifier si le formulaire a été soumis
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Récupérer les données du formulaire
//     $email = $_POST["e"];
//     $password = $_POST["pwd"];

//     // Valider l'utilisateur dans la base de données
//     if (usernameIsValid($email, $password)) {
//         // L'utilisateur est valide, rediriger vers la page souhaitée
//         header("Location: ../produit/pageProduits.php"); // Remplacez avec le chemin de votre page
//         exit();
//     } else {
//         // L'utilisateur n'est pas valide, afficher un message d'erreur
//         $_SESSION["error_message"] = "Identifiants incorrects. Veuillez réessayer.";
//         header("Location: ../affichage/login.php"); // Rediriger vers la page de formulaire
//         exit();
//     }
// } else {
//     // Rediriger si le formulaire n'a pas été soumis
//     header("Location: ../affichage/login.php");
//     exit();
// }

// // Fonction pour valider l'utilisateur dans la base de données
// function validateUser($email, $password) {
//     // Vous devez implémenter cette fonction en fonction de votre logique d'authentification
//     // Assurez-vous de sécuriser les requêtes SQL (par exemple, utilisez des requêtes préparées)
//     // Retournez true si l'utilisateur est valide, sinon false
//     // Exemple simplifié :
//     $validUser = false;

//     // Connectez-vous à la base de données et exécutez une requête pour vérifier l'utilisateur
//     // ...

//     return $validUser;
// }
// ?>

