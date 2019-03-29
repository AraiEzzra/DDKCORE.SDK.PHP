<?php

namespace DDK\API\Schemas;


class CreateAccount
{
    const schema = [
        'headers' => null,
        'code' => 'CREATE_ACCOUNT',
        'body' => [
            'address' => null,
        ],
    ];
}
