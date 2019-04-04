<?php

namespace DDK\API\Schemas;


class CreateTransaction
{
    const schema = [
        'headers' => null,
        'code' => 'CREATE_TRANSACTION',
        'body' => [
            'secret' => null,
            'trs' => [
                'senderPublicKey' => null,
                'type' => null,
                'asset' => [],
            ],
        ],
    ];
}
