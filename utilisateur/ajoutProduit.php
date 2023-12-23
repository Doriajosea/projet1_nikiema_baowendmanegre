<?php


require_once("../conn/connexion.php");
require_once("../functions/produitCrud.php");
//require_once ('../functions/functions.php');
session_start();
$products = getAllProducts();

if (isset($_SESSION['user_logged_in']) ) {
$name = '';
if (isset($_SESSION['product_form']['name'])) {
    $name = $_SESSION['product_form']['name'];
}



$price = '';
if (isset($_SESSION['product_form']['price'])) {
    $price = $_SESSION['product_form']['price'];
}
$img_url = '';
if (isset($_SESSION['product_form']['img_url'])) {
    $img_url = $_SESSION['product_form']['img_url'];
}
$description = '';
if (isset($_SESSION['product_form']['description'])) {
    $description = $_SESSION['product_form']['description'];
}

$quantity = '';
if (isset($_SESSION['product_form']['quantity'])) {
    $quantity = $_SESSION['product_form']['quantity'];
}
}

?>

<div class="image-item">'
    <img src="../images/naruto.jpeg">
    <p>Naruto</p>
</div>