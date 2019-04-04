<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $secret = "urban sunny rude author cost brave sibling amused burden input escape coach";

    $sdk->send($secret, '87898791777668161189', 100000);

    $sdk->read(function ($responseData) use ($sdk) {
        var_dump($responseData);

        $sdk->connectionClose();
    });

    print "Request finished!\n";
} else {
    print "Wrong\n";
}

