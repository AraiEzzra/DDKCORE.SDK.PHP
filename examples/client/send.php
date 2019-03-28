<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->send('7897332094363171058', 99);

    $sdk->read(function ($responseData) use ($sdk) {
        var_dump($responseData);

        $sdk->connectionClose();
    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}

