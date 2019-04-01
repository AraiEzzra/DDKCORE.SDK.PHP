<?php

namespace DDK\API;


use DDK\API\Schemas\CommonResponse;
use DDK\Validation\ArrayKeysValidator;
use ElephantIO\Payload\Decoder;

class Response
{
    private $eventName;

    private $responseData = [];

    public function __construct($response)
    {
        $this->removeMagicNumber($response);
    }

    public function removeMagicNumber($response)
    {
        if (strpos($response, '42') === 0) {
            $response = json_decode(substr($response, 2), true);
        }

        if (is_array($response) AND count($response) === 2) {
            $this->eventName = $response[0];
            $this->responseData = $response[1];
        }
    }

    public function validate(): bool
    {
        return ArrayKeysValidator::validate($this->responseData, CommonResponse::keys());
    }

    public function data(): array
    {
        return $this->responseData;
    }

}
