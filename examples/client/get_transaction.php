<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $sdk->getTransaction('f0bb22ee63fd07be1c8250662e418bc57c5dbeaa210773ce5dae248fb252d366');

    $sdk->read(function ($responseData) use ($sdk) {
        print_r(json_encode($responseData));

        $sdk->connectionClose();
    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}

