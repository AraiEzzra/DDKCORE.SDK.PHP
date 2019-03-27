<?php

namespace DDK\API\Schemas;


class GetAccountBalance {
    const schema = [
        'headers' => null,
        'code' => 'GET_ACCOUNT_BALANCE',
        'body' => [
            'address' => null,
            'filter' => [
                'limit' => 5,
                'offset' => 1,
            ],
        ],
    ];
}
