<?php

namespace DDK\API;


class Headers {

    const HeaderType = 1;

    public function baseHeader($type = self::HeaderType)
    {
        return [
            'id' => rand(1000, 10000000),
            'type' => $type,
        ];
    }

}
