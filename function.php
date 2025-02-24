<?php
session_start();
function dd($value) 
{ 
    echo "<pre>"; 
    var_dump($value); 
    echo "</pre>"; 
    die(); 
} 

function urlIs($path) {
    // Get the current page from GET parameter
    $currentPage = $_GET['page'] ?? 'index';
    
    // Remove .php extension and compare
    $path = str_replace('.php', '', $path);
    
    return $currentPage === $path;
}
function isLoggedIn() {
    return isset($_SESSION['username']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: auth/login.php');
        exit();
    }
}
