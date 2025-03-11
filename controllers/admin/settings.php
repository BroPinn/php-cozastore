<?php

class SettingsController {
    public function __construct() {
        // Initialize any necessary models
    }

    public function index() {
        // Load the settings view
        require_once __DIR__ . '/../../views/admin/settings.view.php';
    }
}

$settingsController = new SettingsController();
$settingsController->index();