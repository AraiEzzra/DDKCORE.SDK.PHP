<?php

namespace DDK\API\Schemas;


class CommonResponse
{
    const schema = [
        'code' => null,
        'headers' => null,
        'body' => [
            'success' => null,
            'errors' => null,
            'data' => null,
        ],
    ];

    static function keys () {
        return array_keys(self::schema);
    }
}
