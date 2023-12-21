<?php


function createUser(array $data)
{
    global $conn;


     var_dump("Je suis dans mon create user");
    $query = "INSERT INTO `user` ( `user_name`, `email`, `pwd`, `fname`, `lname`, `billing_address_id`, `shipping_address_id`, `token`, `role_id`) VALUES (?,?,?,?,?,1,1,?,3)";
 
    if ($stmt = mysqli_prepare($conn, $query)) {
 
        mysqli_stmt_bind_param(
            $stmt,
            "ssssss",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['nom'],
            $data['prenom'],
            $data['token'],
        );
        $result = mysqli_stmt_execute($stmt);

        var_dump(mysqli_error ($conn));
        die;
    }
}
/**
 * Get all users
 */
function getAllUsers()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_assoc($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    return $data;
}

function changeToken($data) {
    global $conn;
    $query = 'UPDATE user set token =? where user.id =?;';
    if ($stmt= mysqli_prepare($conn,$query)) {
        mysqli_stmt_bind_param(
            $stmt,
            'si',
            $data['id'],
            $data['token'],
        );
        $result=mysqli_stmt_execute($stmt);
    }


}



function getUserById(int $id)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM user WHERE id = " . $id);

    $data = mysqli_fetch_assoc($result);

    return $data;
}

function getUserByUsername(string $user_name)
{
    global $conn;

    $query = "SELECT * FROM user WHERE user.user_name = '" . $user_name . "';";

    $result = mysqli_query($conn, $query);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_assoc($result);
    return $data;
}


function updateUser(array $data)
{
    global $conn;

    $query = "UPDATE user SET user_name = ?, email = ?, pwd = ?
            WHERE user.id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['id'],
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
}
/**
 * Delete user
 */
function deleteUser(int $id)
{
    global $conn;

    $query = "DELETE FROM user
                WHERE user.id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id,
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
    }
}