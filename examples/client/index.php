<?php

require __DIR__ . '/../bootstrap.php';


use \DDK\API\Method;


if ($sdk->connection()) {

    $sdk->request(
        Method::GET_TRANSACTIONS,
        [
            'limit' => 100,
            'offset' => 50,
        ]
    );

    $sdk->read(function ($responseData) use ($sdk) {
        var_dump($responseData);

        $sdk->connectionClose();
    });

    print 'Request finished!';
} else {
    print 'Wrong';
}

