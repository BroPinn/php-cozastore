<?php
require_once __DIR__ . '/../database.php';

class ProductModel {  
    public $productID;
    public $categoryID;
    public $productName;
    public $price;
    public $description;
    public $image_path;
    public $updated_at;
    public $created_at;
}

function getProducts() {
    try {
        $pdo = connectToDatabase();
        if (!$pdo) {
            throw new Exception("Database connection failed");
        }
        
        $stmt = $pdo->query("CALL GetAllProducts()");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Product Fetch Error: " . $e->getMessage());
        return [];
    } catch (Exception $e) {
        error_log("General Error: " . $e->getMessage());
        return [];
    }
}

function getProductById($productID) {
    try {
        $pdo = connectToDatabase();
        if (!$pdo) {
            throw new Exception("Database connection failed");
        }

        $stmt = $pdo->prepare("CALL GetProductById(?)");
        $stmt->execute([$productID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Product Fetch Error: " . $e->getMessage());
        return null;
    }
}

function createProduct($categoryID, $productName, $price, $description, $image_path) {
    try {
        $pdo = connectToDatabase();
        if (!$pdo) {
            throw new Exception("Database connection failed");
        }

        $stmt = $pdo->prepare("CALL CreateProduct(?, ?, ?, ?, ?)");
        return $stmt->execute([
            $categoryID,
            $productName,
            $price,
            $description,
            $image_path
        ]);
    } catch (PDOException $e) {
        error_log("Product Creation Error: " . $e->getMessage());
        return false;
    }
}

function updateProduct($productID, $categoryID, $productName, $price, $description, $image_path) {
    try {
        $pdo = connectToDatabase();
        if (!$pdo) {
            throw new Exception("Database connection failed");
        }

        $stmt = $pdo->prepare("CALL UpdateProduct(?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $productID,
            $categoryID,
            $productName,
            $price,
            $description,
            $image_path
        ]);
    } catch (PDOException $e) {
        error_log("Product Update Error: " . $e->getMessage());
        return false;
    }
}

function deleteProduct($productID) {
    try {
        $pdo = connectToDatabase();
        if (!$pdo) {
            throw new Exception("Database connection failed");
        }

        $stmt = $pdo->prepare("CALL DeleteProduct(?)");
        return $stmt->execute([$productID]);
    } catch (PDOException $e) {
        error_log("Product Deletion Error: " . $e->getMessage());
        return false;
    }
}