<?php

require_once 'config.php';

// Define the base directory for the app - app/
define('APP_DIR', __DIR__ . '/includes/');

spl_autoload_register(function ($class) {

    // Replace backslashes with forward slashes
    $class = str_replace('\\', '/', $class);

    $file = APP_DIR . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
