<?php

namespace DDK\API\Schemas;


class GetTransactionsByIdBlock
{
    const schema = [
        'headers' => null,
        'code' => 'GET_TRANSACTIONS_BY_BLOCK_ID',
        'body' => [
            'blockId' => null,
            'limit' => 10,
            'offset' => 0,
        ],
    ];
}
