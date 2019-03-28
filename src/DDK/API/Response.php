<?php

namespace DDK\API;


use DDK\API\Method;
use DDK\Validation\ArrayKeysValidator;

class Response {



    private $responseData = [];

    public function __construct($response)
    {
        $this->responseData = $response;
    }

    public function validate()
    {
        return ArrayKeysValidator::validate($this->responseData, ['headers', 'code', 'body']);
    }

}
