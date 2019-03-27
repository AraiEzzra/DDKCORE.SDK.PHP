<?php

namespace DDK\API\Schemas;


class GetTransaction {
    const schema = [
        'headers' => null,
        'code' => 'GET_TRANSACTION',
        'body' => [
            'id' => null,
        ],
    ];
}
