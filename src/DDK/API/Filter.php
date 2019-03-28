<?php

namespace DDK\API;


use DDK\Validation\NumericValidator;

const FILTER_DEFAULT_VALUES = [
    'limit' => 10,
    'offset' => 0,
];

class Filter
{
    private $values = FILTER_DEFAULT_VALUES;

    public function __construct($limit = FILTER_DEFAULT_VALUES['limit'], $offset = FILTER_DEFAULT_VALUES['offset'])
    {
        $this->limit($limit);
        $this->offset($offset);
    }

    public function limit($num)
    {
        if (NumericValidator::validate($num)) {
            $this->values['limit'] = $num;
        }
    }

    public function offset($num)
    {
        if (NumericValidator::validate($num)) {
            $this->values['offset'] = $num;
        }
    }

    public function values()
    {
        return $this->values;
    }

}