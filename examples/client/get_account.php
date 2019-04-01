<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getAccount('7897332094363171058');

    try {
        $sdk->read(function ($responseData) use ($sdk) {

            if (!empty($responseData) && $responseData['code']) {
                print_r(json_encode($responseData['code']) . "\n");
            }

//            if ($responseData && $responseData['code'] === \DDK\API\Method::GET_ACCOUNT) {
//                print_r(json_encode($responseData));
//                $sdk->connectionClose();
//            }

        });

    } catch (Exception $err) {
        print_r("ERR >> " . json_encode($err) . "\n");
        exit;
    }

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
