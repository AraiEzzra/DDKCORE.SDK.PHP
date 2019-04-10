<?php

require __DIR__ . '/../bootstrap.php';


$passpharse = $sdk->createPasspharse();
$keyPair = \DDK\Crypto\KeyPair::makeKeyPair($passpharse);

var_dump($passpharse);
var_dump($keyPair);
