<?php

require __DIR__ . '/../bootstrap.php';


$passpharse = $sdk->createPasspharse();
var_dump($passpharse);
$keyPair = \DDK\Crypto\KeyPair::makeKeyPair($passpharse);
var_dump($keyPair);
$address = \DDK\Crypto\KeyPair::getAddressFromPublicKey($keyPair['publicKey']);
var_dump($address);
