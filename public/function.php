<?php
session_start(); // Ensure session starts

function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        $redirectTo = (strpos($_SERVER['REQUEST_URI'], '/admin/') !== false) ? '/admin/' : '/auth/client/login.php';
        header("Location: $redirectTo");
        exit();
    }
}

function getRoute($name) {
    static $routes = [
        'admin_login'     => '/admin/',
        'admin_dashboard' => '/admin/index',
        'admin_slider'    => '/admin/slider',
        'admin_product'   => '/admin/product',
        'admin_category'  => '/admin/category',
        'admin_brand'     => '/admin/brand',
        'admin_page'      => '/admin/page',
        'admin_user'      => '/admin/user',
        'admin_settings'  => '/admin/settings',
        'home'            => '/',
        'shop'            => '/shop',
        'cart'            => '/cart',
        'checkout'        => '/checkout',
        'account'         => '/account',
        'login'           => '/auth/client/login.php',
        'register'        => '/auth/client/register.php',
    ];

    return $routes[$name] ?? '/';
}
