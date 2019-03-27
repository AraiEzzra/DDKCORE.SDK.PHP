<?php

namespace DDK\API\Schemas;


class GetTransactions {
    const schema = [
        'headers' => null,
        'code' => 'GET_TRANSACTIONS',
        'body' => [
            'filter' => [],
            'sort' => [['type', 'ASC'], ['createdAt', 'ASC']],
            'limit' => 10,
            'offset' => 0,
        ],
    ];
}
