<?php

namespace DDK\API;


use DDK\API\Method;
use DDK\API\Headers;
use DDK\API\Options;
use DDK\API\Schema;

class Request {

    private $schema;

    public function __construct($methodName, array $options = [])
    {
        // TODO: validate me more
        if (defined("\DDK\API\Method::$methodName")) {
            $headers = new Headers();

            $this->schema = constant('\DDK\API\Schema::'. $methodName);
            $this->schema['headers'] = $headers->baseHeader();
            $this->schema['body'] = array_merge($this->schema['body'], $options);
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
