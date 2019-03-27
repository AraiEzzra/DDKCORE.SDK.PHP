<?php

require __DIR__ . '/../bootstrap.php';


use \DDK\API\Method;
use \DDK\API\Options;


if ($sdk->connection()) {

    $sdk->request(
        Method::GET_TRANSACTIONS,
        [
            'limit' => 100,
            'offset' => 50,
        ]
    );

    $sdk->read(function ($responseData) use ($sdk) {
        print "\nResponse Data:\n";
        print_r($responseData);
        // $sdk->connectionClose();
    });

    print 'Request finished!';
} else {
    print 'Wrong';
}

