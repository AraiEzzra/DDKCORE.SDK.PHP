<?php

namespace DDK\Validation;


class ArrayKeysValidator
{

    /**
     * Helper method for validating an keys in array.
     *
     * @param array $array The array to be validated
     * @param array $keys  The names of the keys to validation
     *
     * @return bool
     */
    public static function validate(array $array, array $keys)
    {
        if ($array === null OR $keys === null) {
            throw new \InvalidArgumentException("params cannot be null");
        }

        foreach ($keys as $keyName) {
            if (!array_key_exists($keyName, $array)) {
                throw new \InvalidArgumentException("$keyName is not exist in validate array");
            }
        }

        return true;
    }
}