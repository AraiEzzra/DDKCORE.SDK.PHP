<?php


class FailedConnectionException extends DDKException
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->messageIntro . $message, $code, $previous);
    }

}