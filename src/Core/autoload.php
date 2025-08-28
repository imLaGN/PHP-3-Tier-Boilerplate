<?php

spl_autoload_register(function ($class) {
    // Convert namespace to file path
    $app_prefix = 'App\\';
    $app_dir = __DIR__ . '/../app/';

    // App classes
    if (str_starts_with($class, $app_prefix)) {
        $relative_class = substr($class, strlen($app_prefix));
        $file = $app_dir . str_replace('\\', '/', $relative_class) . '.php';
    }
    else {
        return;
    }

    if (file_exists($file)) {
        require $file;
    }
});