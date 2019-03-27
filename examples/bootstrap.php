<?php

include dirname(__DIR__) . '/vendor/autoload.php';
include dirname(__DIR__) . '/src/autoload.php';


// Configure library, address to DDK Node

$sdk = new DDK\SDK([
    'host' => '127.0.0.1',
    'port' => 8000,
]);
