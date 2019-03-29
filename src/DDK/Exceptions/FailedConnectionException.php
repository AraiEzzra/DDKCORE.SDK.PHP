<?php

namespace DDK\Exceptions;


use \DDK\Exceptions\DDKException;

class FailedConnectionException extends DDKException
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}