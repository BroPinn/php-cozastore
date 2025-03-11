<?php
require_once __DIR__ . '/../../config.php';
require_once PUBLIC_DIR . '/database.php';
require_once PUBLIC_DIR . '/function.php';

$db = new Database();
$pdo = $db->getConnection();

$error = null;

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Please fill in all fields.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM tbl_admin WHERE username = :username LIMIT 1");
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && $password === $admin['password']) { 
            $_SESSION['username'] = $admin['username'];
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['logged_in'] = true;
        
            header("Location: " . getRoute('admin_dashboard'));
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}

// Include the login view
require ADMIN_VIEWS_DIR . '/login.view.php';