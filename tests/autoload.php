<?php

if (version_compare(PHP_VERSION, '7', '<')) {
    throw new Exception('The DDK SDK requires PHP version 7 or higher.');
}

set_include_path(__DIR__);
define('SYSTEM_DIR', get_include_path() . DIRECTORY_SEPARATOR);


spl_autoload_register(
    function ($className) {
        $file = SYSTEM_DIR . rtrim(str_replace('\\', '/', $className), '/');

        if (file_exists($file . '.php')) {
            require_once $file . '.php';
        }
    }
);
