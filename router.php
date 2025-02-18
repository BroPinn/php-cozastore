<?php
$controllersPath = __DIR__ . '/controllers/';
$pages = array_map(function($file) {
    return basename($file, '.php');
}, array_filter(glob($controllersPath . '*.php'), 'is_file'));

// Get the requested page
$page = $_GET['page'] ?? 'index';

// Route the page
if (in_array($page, $pages)) {
    require "controllers/{$page}.php";
} else {
    // Show 404 page for invalid routes
    header("HTTP/1.0 404 Not Found");
    require 'views/404.view.php';
    exit();
}