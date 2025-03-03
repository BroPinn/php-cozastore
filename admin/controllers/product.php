<?php
require_once __DIR__ . '/../../models/ProductModel.php';

$heading = "Product";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productModel = new ProductModel();
    
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                // Handle product creation
                $productModel->createProduct(
                    $_POST['catName'],
                    $_POST['productName'],
                    $_POST['price'],
                    $_POST['description'],
                    $_POST['image_path']
                );
                break;
            // Add other cases as needed
        }
    }
}

require "view/product.view.php";