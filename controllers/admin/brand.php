<?php

class BrandController {
    public function __construct() {
        // Initialize any necessary models
    }

    public function index() {
        // Load the brand view
        require_once __DIR__ . '/../../views/admin/brand.view.php';
    }
}

$brandController = new BrandController();
$brandController->index();