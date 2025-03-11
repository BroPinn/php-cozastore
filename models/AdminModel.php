<?php
<<<<<<< HEAD
require_once __DIR__ . '/../database.php';
function getAdminData($username) {
    $pdo = connectToDatabase();
    if ($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    return null;
}
?>
=======
class AdminModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAdminData($username) {
        try {
            $pdo = $this->db->getConnection();
            if (!$pdo) {
                throw new Exception("Database connection failed");
            }

            $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Admin Data Fetch Error: " . $e->getMessage());
            return null;
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            return null;
        }
    }
}
>>>>>>> ad0678e (Re Structure)
