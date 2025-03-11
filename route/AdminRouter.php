<?php
require_once __DIR__ . '/../config.php';

class AdminRouter {
    private static $routes = [
        'admin_login'     => '/admin/',
        'admin_dashboard' => '/admin/index',
        'admin_logout'    => '/admin/logout',
        'admin_slider'    => '/admin/slider',
        'admin_product'   => '/admin/product',
        'admin_category'  => '/admin/category',
        'admin_brand'     => '/admin/brand',
        'admin_page'      => '/admin/page',
        'admin_user'      => '/admin/user',
        'admin_settings'  => '/admin/settings'
    ];

    private static $publicRoutes = ['/admin/'];

    public static function getRoute($name) {
        return self::$routes[$name] ?? null;
    }

    public static function getCurrentPage() {
        // First check GET parameter
        if (isset($_GET['page'])) {
            $page = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
            return $page === 'index.php' ? 'index' : $page;
        }

        // Then check URL path
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Handle login page cases
        if ($urlPath === '/admin/' || $urlPath === '/admin') {
            return 'login';
        }

        // Extract the last part of the path
        $pathParts = explode('/', trim($urlPath, '/'));
        $lastPart = end($pathParts);

        // Map common paths to their corresponding pages
        $pathMap = [
            'index.php' => 'index',
            'index' => 'index',
            'slider' => 'slider',
            'product' => 'product',
            'category' => 'category',
            'brand' => 'brand',
            'page' => 'page',
            'user' => 'user',
            'settings' => 'settings',
            '' => 'index'
        ];

        return $pathMap[$lastPart] ?? $lastPart;
    }

    public static function handleAuth() {

        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
            // If not logged in and not on the login page, redirect to admin login
            if (!in_array($currentPath, self::$publicRoutes)) {
                header("Location: /admin/");
                exit();
            }
        } else {
            // If logged in and on login page, redirect to dashboard
            if ($currentPath === '/admin/' || $currentPath === '/admin/index.php') {
                header("Location: /admin/index");
                exit();
            }
        }
    }
}

// Handle authentication
AdminRouter::handleAuth();

// Get the requested page
$page = AdminRouter::getCurrentPage();

// Include controller or show 404
$controllerPath = ADMIN_CONTROLLERS_DIR . "/{$page}.php";
if (file_exists($controllerPath)) {
    require $controllerPath;
} else {
    header("HTTP/1.0 404 Not Found");
    require ADMIN_VIEWS_DIR . '/404.view.php';
    exit();
}
