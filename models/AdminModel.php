<?php
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