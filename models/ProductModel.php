<?php
class ProductModel {
    private $productID;
    private $catName;
    private $productName;
    private $price;
    private $description;
    private $image_path;
    private $updated_at;
    private $created_at;

    public function __construct() {
        // Initialize any necessary properties
    }

    public function getProducts() {
        try {
            global $pdo;
        
        // If $pdo is not set, establish database connection
        if (!isset($pdo)) {
            $pdo = connectToDatabase();
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

    public function getProductById($productID) {
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

    public function createProduct($catID, $productName, $price, $description, $image_path) {
        try {
            $pdo = connectToDatabase();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("CALL CreateProduct(?, ?, ?, ?, ?)");
            return $stmt->execute([
                $catID,
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

    public function updateProduct($productID, $catName, $productName, $price, $description, $image_path) {
        try {
            $pdo = connectToDatabase();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("CALL UpdateProduct(?, ?, ?, ?, ?, ?)");
            return $stmt->execute([
                $productID,
                $catName,
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

    public function deleteProduct($productID) {
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

    // Getters and Setters
    public function getProductID() { return $this->productID; }
    public function getCatName() { return $this->catName; }
    public function getProductName() { return $this->productName; }
    public function getPrice() { return $this->price; }
    public function getDescription() { return $this->description; }
    public function getImagePath() { return $this->image_path; }
    
    public function setProductID($value) { $this->productID = $value; }
    public function setCatName($value) { $this->catName = $value; }
    public function setProductName($value) { $this->productName = $value; }
    public function setPrice($value) { $this->price = $value; }
    public function setDescription($value) { $this->description = $value; }
    public function setImagePath($value) { $this->image_path = $value; }
}