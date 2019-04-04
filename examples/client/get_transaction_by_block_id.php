<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getTransactionsByBlockId('b44f40a6b37bbaea8f110d6792cefd73604fc982bfbec0b6d9e5a0a419761818', 20, 10);

    $sdk->read(function ($responseData) use ($sdk) {
        if ($responseData['code'] === \DDK\API\Method::GET_TRANSACTIONS_BY_BLOCK_ID) {
            print_r(json_encode($responseData));
            $sdk->connectionClose();
        }

    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}


