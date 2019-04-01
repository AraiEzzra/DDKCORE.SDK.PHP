<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getAccount('7897332094363171058');

    $sdk->read(function ($responseData) use ($sdk) {

        if ($responseData['code'] === \DDK\API\Method::GET_ACCOUNT) {
            print_r(json_encode($responseData));
            $sdk->connectionClose();
        }

    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
