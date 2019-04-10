<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $account = $sdk->createAccount();
    var_dump($account);
} else {
    print "Wrong\n";
}
