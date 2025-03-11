<?php

class UserController {
    public function __construct() {
        // Initialize any necessary models
    }

    public function index() {
        // Load the user view
        require_once __DIR__ . '/../../views/admin/user.view.php';
    }
}

$userController = new UserController();
$userController->index();