<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getAccountBalance('3027610744287867105');

    $sdk->read(function ($responseData) use ($sdk) {

        if ($responseData['code'] === \DDK\API\Method::GET_ACCOUNT_BALANCE) {
            print_r(json_encode($responseData));
            // {"code":"GET_ACCOUNT_BALANCE","headers":{"id":"a73a9124-3c8d-4363-92ea-2f9b70633174","type":2},"body":{"success":true,"errors":[],"data":0}}Request finished!

            $sdk->connectionClose();
        }

    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
