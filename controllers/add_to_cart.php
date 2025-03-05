<?php
require_once __DIR__ . './service/cart_functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productID = $_POST['product_id'] ?? '';
    $productName = $_POST['product_name'] ?? '';
    $price = floatval($_POST['price']) ?? 0;
    $image = $_POST['image'] ?? '';
    
    try {
        addToCart($productID, $productName, $price, $image);
        $_SESSION['message'] = 'Product added to cart successfully!';
    } catch (Exception $e) {
        $_SESSION['error'] = 'Error adding product to cart';
    }
    
    // Redirect back to previous page
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

header('Location: index.php');
exit();
