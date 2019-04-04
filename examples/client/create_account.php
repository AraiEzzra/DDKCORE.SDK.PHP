<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->createAccount();

    // You can catch `TypeError` exceptions to avoid critical errors when validating a response for example
    try {
        $sdk->read(function ($responseData) use ($sdk) {

            if ($responseData['code'] === \DDK\API\Method::CREATE_TRANSACTION) {
                print_r(json_encode($responseData));

                // If connection was not closed, reading will be closed in a loop
                $sdk->connectionClose();
            }
        });

    } catch (TypeError $error) {
        print "TypeError: " . $error->getMessage();
    }

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
