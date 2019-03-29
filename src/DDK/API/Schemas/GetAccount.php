<?php

namespace DDK\API\Schemas;


class GetAccount
{
    const schema = [
        'headers' => null,
        'code' => 'GET_ACCOUNT',
        'body' => [
            'address' => null,
        ],
    ];
}
