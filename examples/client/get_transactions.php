<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getTransactions(20, 10, ['type' => 'ASC']);

    $sdk->read(function ($responseData) use ($sdk) {
        var_dump($responseData);

        $sdk->connectionClose();
    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}

