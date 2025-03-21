<?php
session_start();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$productID = $_POST['productID'];
$productName = $_POST['productName'];
$price = $_POST['price'];
$imagePath = $_POST['imagePath'];
$quantity = 1; // Default quantity

// Check if the product is already in the cart
$found = false;
foreach ($_SESSION['cart'] as &$item) {
    if ($item['productID'] == $productID) {
        $item['quantity'] += 1; // Increment the quantity
        $found = true;
        break;
    }
}

if (!$found) {
    // Add new product to the cart
    $_SESSION['cart'][] = [
        'productID' => $productID,
        'productName' => $productName,
        'price' => $price,
        'image_path' => $imagePath,
        'quantity' => $quantity
    ];
}

// Redirect to the cart or checkout page
header("Location: ../index.php?page=checkout");
exit();