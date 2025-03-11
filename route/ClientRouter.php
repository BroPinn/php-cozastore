<?php
require_once __DIR__ . '/../config.php';

function getClientPages() {
    return array_map(function($file) {
        return basename($file, '.php');
    }, array_filter(glob(CLIENT_CONTROLLERS_DIR . '/*.php'), 'is_file'));
}

function getCurrentPage() {
    if (!isset($_GET['page'])) {
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $pathParts = explode('/', trim($urlPath, '/'));
        $page = end($pathParts);
        return empty($page) ? 'index' : $page;
    }
    return htmlspecialchars($_GET['page'] ?? 'index', ENT_QUOTES, 'UTF-8');
}

$page = getCurrentPage();
$pages = getClientPages();

// Route the page
if (in_array($page, $pages)) {
    require CLIENT_CONTROLLERS_DIR . "/{$page}.php";
} else {
    // Show 404 page for invalid routes
    header("HTTP/1.0 404 Not Found");
    require CLIENT_VIEWS_DIR . '/404.view.php';
    exit();
}