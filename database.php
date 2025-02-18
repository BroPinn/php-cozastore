<?php
// c:\xampp\htdocs\m3\cozastore-master\database.php

function connectToDatabase() {
    try {
        $dsn = 'mysql:host=localhost;dbname=onestore_db;charset=utf8';
        $pdo = new PDO($dsn, 'root', '');
        
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
        return $pdo;
    } catch(PDOException $e) {
        // Log error or handle gracefully
        error_log("Database Connection Error: " . $e->getMessage());
        throw $e;
    }
}

function getAllAdmins($pdo) {
    $statement = $pdo->prepare('SELECT * FROM tbl_admin');
    $statement->execute();
    return $statement->fetchAll();
}