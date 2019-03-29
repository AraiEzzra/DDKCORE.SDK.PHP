<?php

namespace DDK\API\Schemas;


class GetBlock
{
    const schema = [
        'headers' => null,
        'code' => 'GET_BLOCK',
        'body' => [
            'id' => null,
        ],
    ];
}
