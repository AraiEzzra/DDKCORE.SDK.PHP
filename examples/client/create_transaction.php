<?php

require __DIR__ . '/../bootstrap.php';


if ($sdk->connection()) {

    $secret = "urban sunny rude author cost brave sibling amused burden input escape coach";

    $type = \DDK\API\TransactionType::SEND;

    $sdk->createTransaction($secret, $type, [
        "amount" => 100000,
        "recipientAddress" => "13917551777668161185"
    ]);

    try {
        $sdk->read(function ($responseData) use ($sdk) {
            print_r(json_encode($responseData));

            $sdk->connectionClose();
        });
    } catch (TypeError $error) {
        print "TypeError: " . $error->getMessage();
    }

    print "Request finished!\n";
} else {
    print "Wrong\n";
}
