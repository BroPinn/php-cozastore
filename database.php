<?php
function connectToDatabase() {
    $host = 'localhost';
    $dbname = 'onestore_db';
    $username = 'root';
    $password = '';

    try {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $pdo = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false // Improves security for prepared statements
        ]);

        // Set the collation
        $pdo->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");

        return $pdo;
    } catch (PDOException $e) {
        error_log("Database Connection Error: " . $e->getMessage());
        return null; // Return null instead of throwing an exception
    }
}