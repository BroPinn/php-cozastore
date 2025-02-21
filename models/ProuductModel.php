<?php

function getProducts() {
    try {
        $pdo = connectToDatabase();
        
        // Enable error reporting for PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $pdo->query('SELECT 
            productName as name, 
            price,
            image_path as image
        FROM tbl_product 
        LIMIT 10');  // Limit to 10 products to improve performance
        
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Debug: Log number of products
        error_log("Products fetched: " . count($products));
        
        return $products;
    } catch (PDOException $e) {
        // Detailed error logging
        error_log("Product Fetch Error: " . $e->getMessage());
        error_log("SQL Error Info: " . print_r($pdo->errorInfo(), true));
        return [];
    }
}