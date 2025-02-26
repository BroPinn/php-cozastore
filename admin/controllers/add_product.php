<?php
require_once __DIR__ . '/../../models/ProductModel.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $categoryID = $_POST['catID'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $image = $_FILES['image'];

    // Handle image upload
    $targetDir = __DIR__ . '/../../upload/image/';
    $targetFile = $targetDir . basename($image['name']);
    $imagePath = 'upload/image/' . basename($image['name']);

    if (move_uploaded_file($image['tmp_name'], $targetFile)) {
        // Image uploaded successfully
        if (createProduct($categoryID, $productName, $price, $description, $imagePath)) {
            header('Location: index.php?page=product');
            exit();
        } else {
            $error = 'Failed to add product.';
        }
    } else {
        $error = 'Failed to upload image.';
    }
}
?>