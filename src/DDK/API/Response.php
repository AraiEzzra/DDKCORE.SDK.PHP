<?php

namespace DDK\API;


use DDK\API\Method;

class Response {

    private $responseData = [];

    public function __construct($response)
    {
        // TODO: validate
        $this->responseData = $response;
    }

}
