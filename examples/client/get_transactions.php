<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getTransactions(20, 10, [ ['type', 'ASC'] ]);

    $sdk->read(function ($responseData) use ($sdk) {
        if ($responseData['code'] === \DDK\API\Method::GET_TRANSACTIONS) {
            print_r(json_encode($responseData));
            $sdk->connectionClose();
        }

    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}

