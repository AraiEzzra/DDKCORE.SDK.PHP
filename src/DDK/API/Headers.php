<?php

namespace DDK\API;




class Headers {

    const HeaderType = 1;

    public function __construct()
    {

    }

    public function baseHeader()
    {
        return [
            'id' => rand(999999, 1000000),
            'type' => self::HeaderType
        ];
    }

}
