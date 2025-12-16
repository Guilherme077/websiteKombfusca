<?php

spl_autoload_register(function ($className) {
    $baseDir = __DIR__ . '/classes/'; 

    $file = $baseDir . strtolower($className) . '.php'; 

    if (file_exists($file)) {
        require_once $file;
    }
});
