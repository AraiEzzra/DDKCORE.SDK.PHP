<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {
    $passpharse = $sdk->createPasspharse();
    $account = $sdk->createAccount($passpharse);
    var_dump($account);
} else {
    print "Wrong\n";
}
