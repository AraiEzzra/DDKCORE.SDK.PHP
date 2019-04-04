<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getAccount('3027610744287867105');

    $sdk->read(function ($responseData) use ($sdk) {

        if ($responseData['code'] === \DDK\API\Method::GET_ACCOUNT) {
            print_r(json_encode($responseData));
            // {"code":"GET_ACCOUNT","headers":{"id":"7536d656-e174-430f-be15-1a8d0cc35277","type":2},"body":{"success":true,"errors":[],"data":{"address":"3027610744287867105","isDelegate":false,"publicKey":"88f668b42f56af44df6c543369dd2dd7a4e771f6fe7926e760b7f5ae6670bce6","actualBalance":0,"referrals":[],"votes":[],"stakes":[]}}}Request finished!

            $sdk->connectionClose();
        }

    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
