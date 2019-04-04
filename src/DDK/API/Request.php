<?php

namespace DDK\API;


use DDK\API\Method;
use DDK\API\Header;
use DDK\API\Options;
use DDK\API\Schema;

class Request {

    private $schema;

    public function __construct($methodName, array $body = [], string $code = null)
    {
        // TODO: validate me more
        if (defined("\DDK\API\Method::$methodName")) {
            $headers = new Header();

            $this->schema = constant('\DDK\API\Schema::'. $methodName);
            $this->schema['headers'] = $headers->baseHeaders();
            $this->schema['body'] = array_merge($this->schema['body'], $body);

            if ($code) {
                $this->schema['code'] = $code;
            }

        } else {
            throw new \DDKException('API Method not found!');
        }

    }

    /**
     * @return array
     */
    public function prepareOption()
    {
        return $this->schema;
    }
}
