<?php


class DDKException extends Exception
{

    public $messageIntro = 'DDK SDK Specificity Exception: ';

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($this->messageIntro . $message, $code, $previous);
    }

}