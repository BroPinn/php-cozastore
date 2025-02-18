<?php
function dd($value) 
{ 
    echo "<pre>"; 
    var_dump($value); 
    echo "</pre>"; 
    die(); 
} 

function urlIs($value) { 
    $currentUrl = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    $value = trim($value, '/');
    var_dump($currentUrl, $value); // Debugging output
    return $currentUrl === $value; 
}