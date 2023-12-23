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
            $data['lname'],
            $data['fname'],
            $data['token'],
        );
        $result = mysqli_stmt_execute($stmt);

        var_dump(mysqli_error ($conn));
        die;
    }
}

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

    $query = "UPDATE user SET user_name = ?, email = ?, pwd = ? WHERE user.id = ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "sssi",
            $data['user_name'],
            $data['email'],
            $data['pwd'],
            $data['id'],
        );

        $result = mysqli_stmt_execute($stmt);
    }
}


function updateUserbyAdmin($user_id, $data)
{
    global $conn;

    $query = "UPDATE user SET email = ?, pwd = ?, fname = ?, lname = ?, user_name = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param(
            $stmt,
            "sssssi",
            $data['email'],
            $data['pwd'],
            $data['fname'],
            $data['lname'],
            $data['user_name'],
            $user_id
        );

        // Execution of the query
        $result = mysqli_stmt_execute($stmt);
        return $result;
    }

    return false;
}


function updateUserAddresses($conn, $userID, $billingAddressID, $shippingAddressID) {
    // Update the user's billing address ID
    $updateBillingAddressID = mysqli_prepare($conn, "UPDATE user SET billing_address_id = ? WHERE user.id = ?");
    mysqli_stmt_bind_param($updateBillingAddressID, 'ii', $billingAddressID, $userID);
    mysqli_stmt_execute($updateBillingAddressID);

    // Update the user's shipping address ID
    $updateShippingAddressID = mysqli_prepare($conn, "UPDATE user SET shipping_address_id = ? WHERE user.id = ?");
    mysqli_stmt_bind_param($updateShippingAddressID, 'ii', $shippingAddressID, $userID);
    mysqli_stmt_execute($updateShippingAddressID);

    mysqli_stmt_close($updateBillingAddressID);
    mysqli_stmt_close($updateShippingAddressID);
}



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



function updateUserToken($userId, $token) {
    global $conn;
    $sql = "UPDATE user SET token = '$token' WHERE id = $userId";
    mysqli_query($conn, $sql);

}



function updateUserRole($user_id, $new_role_id)
{
    global $conn;

    $query = "UPDATE user SET role_id = ? WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $new_role_id, $user_id);

        
        $result = mysqli_stmt_execute($stmt);
        return $result;
    }

    return false; 
}


function getClients()
{
    global $conn;

    $query = "SELECT * FROM user WHERE role_id = 3"; 
    $result = mysqli_query($conn, $query);

    $clients = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $clients[] = $row;
    }

    return $clients;
}

