<?php

class Database {
    private $host = 'localhost';
    private $dbname = 'onestore_db';
    private $username = 'root';
    private $password = '';
    private $pdo;
    
    public function __construct() {
        $this->connect();
    }

    private function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);

            // Set the collation
            $this->pdo->exec("SET NAMES 'utf8mb4' COLLATE 'utf8mb4_general_ci'");
        } catch (PDOException $e) {
            error_log("Database Connection Error: " . $e->getMessage());
            $this->pdo = null; // Ensures null is returned if the connection fails
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}

// Usage example
$db = new Database();
$pdo = $db->getConnection();
