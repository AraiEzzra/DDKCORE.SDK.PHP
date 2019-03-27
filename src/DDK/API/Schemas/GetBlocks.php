<?php

namespace DDK\API\Schemas;


class GetBlocks {
    const schema = [
        'headers' => null,
        'code' => 'GET_BLOCKS',
        'body' => [
            'filter' => [],
            'sort' => [['createdAt', 'ASC']],
            'limit' => 10,
            'offset' => 0,
        ],
    ];
}