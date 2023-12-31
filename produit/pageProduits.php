<a href="../">Accueil</a>
<?php
require_once "../functions/encode.php";
require_once "../functions/validation.php";
require_once "../conn/connexion.php";
require_once "../functions/userCrud.php";
session_start();
var_dump($_POST);


?>


<h1><center><i>BIENVENUE SUR NOTRE SITE DE LOCATION DE MANGE</i></center></h1>


<?php


// Check if the product ID is provided
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details
    $product = getProductById($productId);

    if ($product) {
        // Check if the "Add to Cart" button is clicked
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['add_to_cart'])) {
            // Perform the cart action (add/update)
            include("addToCart.php");

            // Redirect back to the product detail page
            header("Location: productDetail.php?id={$productId}");
            exit();
        }

        // Display detailed information about the product
?>
<?php include "../public/header.php"; ?>

<main>
    <section class="product-details">
        <div class="product">
            <img src="<?php echo $product['img_url']; ?>" class="my_img">
            <h2><?php echo $product['name']; ?></h2>
            <p><b>Item Description:</b> <?php echo $product['description']; ?></p>
            <span class="price"><b>Price:</b> $<?php echo $product['price']; ?></span><br>
            <span class="quantity"><b>Quantity left:</b> <?php echo $product['quantity']; ?></span><br>
            <br>
            <a href="productDetail.php?id=<?php echo $product['id']; ?>&add_to_cart" class="btn btn-primary add-to-cart-btn">
                <i class="bi bi-cart-plus-fill"></i> Add to Cart
            </a>

            <?php
                // Display cart message if set
                if (isset($_SESSION['cart_message'])) {
                    echo "<p>{$_SESSION['cart_message']}</p>";

                    // Clear the message after displaying it
                    unset($_SESSION['cart_message']);
                }
            ?>
        </div>
    </section>
</main>



<?php
    } else {
        // Handle the case where the product ID does not exist
        echo "Product not found.";
    }
} else {
    // Handle the case where the product ID is not provided
    echo "Product ID is missing.";
}
?>
