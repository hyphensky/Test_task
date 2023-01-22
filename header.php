<?php
require_once "config.php";

spl_autoload_register(function ($class) 
{
    $path = __DIR__ . '/' . $class . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

function html(?string $text) : string
{
    return htmlspecialchars($text ?? '', ENT_QUOTES);
}
  
$pdo = CProducts::connect($host, $db, $user, $pass);