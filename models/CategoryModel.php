<?php
class CategoryModel {
    private $category_id;
    private $category_name;
    private $category_status;
<<<<<<< HEAD

    public function __construct() {
        // Initialize any necessary properties
=======
    private $db;

    public function __construct() {
        $this->db = new Database();
>>>>>>> ad0678e (Re Structure)
    }

    public function getCategories() {
        try {
<<<<<<< HEAD
            $pdo = connectToDatabase();
=======
            $pdo = $this->db->getConnection();
>>>>>>> ad0678e (Re Structure)
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }
            
            $stmt = $pdo->query("CALL GetActiveCategories()");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Category Fetch Error: " . $e->getMessage());
            return [];
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            return [];
        }
    }

    public function getCategoryById($category_id) {
        try {
<<<<<<< HEAD
            $pdo = connectToDatabase();
=======
            $pdo = $this->db->getConnection();
>>>>>>> ad0678e (Re Structure)
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("CALL GetCategoryById(?)");
            $stmt->execute([$category_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Category Fetch Error: " . $e->getMessage());
            return null;
        }
    }
}

