<?php

class PageController {
    public function __construct() {
        // Initialize any necessary models
    }

    public function index() {
        // Load the page view
        require_once __DIR__ . '/../../views/admin/page.view.php';
    }
}

$pageController = new PageController();
$pageController->index();