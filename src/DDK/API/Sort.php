<?php

namespace DDK\API;


use Psr\Log\InvalidArgumentException;

const SORT_DEFAULT_VALUES = [];


class Sort
{
    const ASC = 'ASC';

    const DESC = 'DESC';

    private $values = SORT_DEFAULT_VALUES;

    public function __construct(...$args)
    {
        foreach ($args as $arg) {
            if (is_array($arg) AND count($arg) === 2) {
                $this->by($arg[0], $arg[1]);
            }
        }
    }

    /**
     * Create sort params.
     * @param $key  string field for sort
     * @param $type string default 'ASC'
     * @return int
     */
    public function by($key, $type = 'ASC')
    {
        if ($type !== self::ASC OR $type !== self::DESC) {
            throw new InvalidArgumentException('Param $type should be ASC or DESC');
        }

        return array_push($this->values, [$key, $type]);
    }

    /**
     * Generated params
     * @return array
     */
    public function values()
    {
        return $this->values;
    }

}