<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->createAccount('7897332094363171058');

    // You can catch `TypeError` exceptions to avoid critical errors when validating a response for example
    try {
        $sdk->read(function ($responseData) use ($sdk) {
            var_dump($responseData);

            // If connection was not closed, reading will be closed in a loop
            $sdk->connectionClose();
        });
    } catch (TypeError $error) {
        print "TypeError: " . $error->getMessage();
    }

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
