<?php

//creer un utilisateur
function createProduct(array $data)
{
    global $conn;
    
    $query = "INSERT INTO product VALUES (NULL, ?, ?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $query)) {
        
        mysqli_stmt_bind_param(
            $stmt,
            "sidss",
            $data['name'],
            $data['quantity'],
            $data['price'],
            $data['img_url'],
            $data['description'],
            
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
        return $result;
    };
    

}

//recuperer tous les utilisateurs
function getAllProducts()
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM product");

    $data = [];
    $i = 0;
    while ($rangeeData = mysqli_fetch_assoc($result)) {
        $data[$i] = $rangeeData;
        $i++;
    };

    return $data;
}

//recuperer un user avec son id
 //Todo: edit to prepare
// productCrud.php

function getProductById(int $id)
{
    global $conn;

    $query = "SELECT * FROM product WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $product = mysqli_fetch_assoc($result)) {
        return $product;
    } else {
        return null; // Product not found
    }
}


//recuperer un user avec son nom dutilisateur
function getProductByName(string $name)
{
    global $conn;

    $query = "SELECT * FROM product WHERE product.name = '" . $name . "';";

    $result = mysqli_query($conn, $query);

    // avec fetch row : tableau indexé
    $data = mysqli_fetch_assoc($result);
    return $data;
}

//modifier un utilisateur
function updateProduct(array $data,$user_name)
{
    global $conn;

        $query = "UPDATE product SET name = ?,quantity = ?,price = ?,img_url = ?,description = ? WHERE product.name=?";
        if ($stmt = mysqli_prepare($conn, $query)) {
            
            mysqli_stmt_bind_param(
                $stmt,
                "sidsss",
                $data['name'],
                $data['quantity'],
                $data['price'],
                $data['img_url'],
                $data['description'],
                $name
            );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
        return $result;

    }
}

//supprimer un utilisateur
function deleteProduct($id)
{
    global $conn;

    $query = "DELETE FROM product
                WHERE product.id= ?;";

    if ($stmt = mysqli_prepare($conn, $query)) {

        mysqli_stmt_bind_param(
            $stmt,
            "i",
            $id,
        );

        /* Exécution de la requête */
        $result = mysqli_stmt_execute($stmt);
        return $result;

    }
}