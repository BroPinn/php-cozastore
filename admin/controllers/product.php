<?php
require_once __DIR__ . '/../../models/ProductModel.php';

define('UPLOAD_DIR', '../uploads/images/');
define('ALLOWED_TYPES', ['image/jpeg', 'image/png', 'image/gif']);

$heading = "Product";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productModel = new ProductModel();
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Validate file type
        if (!in_array($_FILES['image']['type'], ALLOWED_TYPES)) {
            $error = "Invalid file type. Please upload JPG, PNG or GIF images only.";
        } else {
            if (!file_exists(UPLOAD_DIR)) {
                if (!@mkdir(UPLOAD_DIR, 0777, true)) {
                    $error = "Failed to create upload directory";
                }
            }

            if (!isset($error)) {
                $fileName = time() . '_' . basename($_FILES['image']['name']);
                $uploadFile = UPLOAD_DIR . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $imagePath = 'uploads/images/' . $fileName;
                    
                    $result = $productModel->createProduct(
                        $_POST['catID'],
                        $_POST['productName'],
                        $_POST['price'],
                        $_POST['description'],
                        $imagePath
                    );

                    if ($result) {
                        header('Location: index.php?page=product&success=1');
                        exit;
                    } else {
                        $error = "Failed to create product";
                    }
                } else {
                    $error = "Failed to upload image";
                }
            }
        }
    } else {
        $error = "Please select an image";
    }
}

require "view/product.view.php";