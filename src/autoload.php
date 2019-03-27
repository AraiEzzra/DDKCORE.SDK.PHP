<?php

if (version_compare(PHP_VERSION, '5.4.0', '<')) {
    throw new Exception('The DDK SDK requires PHP version 5.4 or higher.');
}


set_include_path(__DIR__);
define('SYSTEM_DIR', get_include_path() . DIRECTORY_SEPARATOR);


spl_autoload_register(function ($class) {
    $file = rtrim(SYSTEM_DIR, '/') . '/' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

