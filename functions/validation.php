<?php

function usernameIsValid(string $username): array
{
    $result = [
        'isValid' => true,
        'msg' => ''

    ];

    $userInDB = getUserByUsername($username);

    if (strlen($username) < 2) {
        $result = [
            'isValid' => false,
            'msg' => 'Le nom utilisé est trop court'

        ];
    } elseif (strlen($username) > 20) {
        $result = [
            'isValid' => false,
            'msg' => 'Le nom utilisé est trop long'

        ];
    } elseif ($userInDB) {
        $result = [
            'isValid' => false,
            'msg' => 'Le nom est déjà utilisé'
        ];
    }
    return $result;
}

function emailIsValid($email)
{

    $email_validation_regex = "/^[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&'*+\\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/";
    if (!preg_match($email_validation_regex, $email)) {
        return [
            'isValid' => false,
            'msg' => "Format d'email invalid",
        ];
    }
    return [
        'isValid' => true,
        'msg' => '',
    ];
}

function nomIsValid($lname){
    //minimum 6 max 16
    $length = strlen($lname);

    if ($length < 2) {
        return [
            'isValid' => false,
            'msg' => 'Votre nom est trop court'
        ];
    } elseif ($length > 50) {
        return [
            'isValid' => false,
            'msg' => 'Votre nom est trop long. Doit être inférieur a 50 caractères'
        ];
    }
    return [
        'isValid' => true,
        'msg' => ''
    ];
}

function prenomIsValid($fname){
    $length = strlen($fname);

    if ($length < 2) {
        return [
            'isValid' => false,
            'msg' => 'Votre prenom est trop court'
        ];
    } elseif ($length > 20) {
        return [
            'isValid' => false,
            'msg' => 'Votre prenom est trop long. Doit être inférieur a 20 caractères'
        ];
    }
    return [
        'isValid' => true,
        'msg' => ''
    ];
}

function pwdLenghtValidation($pwd)
{
    //minimum 6 max 16
    $length = strlen($pwd);

    if ($length < 6) {
        return [
            'isValid' => false,
            'msg' => 'Votre mot de passe est trop court. Doit être supérieur a 8 caractères'
        ];
    } elseif ($length > 16) {
        return [
            'isValid' => false,
            'msg' => 'Votre mot de passe est trop long. Doit être inférieur a 16 caractères'
        ];
    }
    return [
        'isValid' => true,
        'msg' => ''
    ];
}