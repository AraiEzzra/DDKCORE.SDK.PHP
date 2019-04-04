<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getTransaction('c7d80bf1bb220e62735bd388549a87c0cd93b8be30a1ae2f7291ce20d2a94b79');

    $sdk->read(function ($responseData) use ($sdk) {

        if ($responseData['code'] === \DDK\API\Method::GET_TRANSACTION) {
            print_r(json_encode($responseData));
            // {"code":"GET_TRANSACTION","headers":{"id":"018d1543-f19a-4187-a0fd-16979ba04e01","type":2},"body":{"success":true,"errors":[],"data":{"id":"c7d80bf1bb220e62735bd388549a87c0cd93b8be30a1ae2f7291ce20d2a94b79","blockId":"cbb9449abb9672d33fa2eb200b1c8b03db7c6572dfb6e59dc334c0ab82b63ab0","type":10,"createdAt":0,"senderPublicKey":"49a2b5e68f851a11058748269a276b0c0d36497215548fb40d4fe4e929d0283a","senderAddress":"12384687466662805891","signature":"226ed984bf3d82b7c332ce48bc976fcc35930d22cb068b2e9de993a4fb3e402d4bdb7077d0923b8dd2c205e6a2473884752615c0787967b218143eec5df1390c","secondSignature":null,"fee":0,"salt":"a7fdae234eeb416e31f5f02571f54a0c","asset":{"recipientAddress":"4995063339468361088","amount":4500000000000000}}}}Request finished!

            $sdk->connectionClose();
        }

    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}

