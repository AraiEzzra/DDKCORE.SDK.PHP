<?php

namespace DDK;


use DDK\API\Channel;
use DDK\API\Request;
use DDK\Client\Connection;
use DDK\Validation\ArrayKeysValidator;
use ElephantIO\Payload\Decoder;


const SDK_REQUIRED_OPTIONS = [
    'host',
    'port'
];

class SDK
{

    /**
     * SDK version
     */
    const VERSION = '0.0.1';

    /**
     * @var array
     */
    protected $config;


    /**
     * @var Connection
     */
    protected $connection;

    public function __construct(array $config = [])
    {
        if (ArrayKeysValidator::validate($config, SDK_REQUIRED_OPTIONS)) {
            $this->config = $config;
        }
    }
    public function connection()
    {
        $this->connection = new Connection(
            $this->config['host'],
            $this->config['port']
        );

        return $this->connection;
    }

    public function connectionClose()
    {
        $this->connection->close();
    }

    public function request($method, array $options = [])
    {
        $request = new Request($method, $options);

        // todo: $this->connection->send();
        $client = $this->connection->client();
        $client->emit(Channel::MESSAGE_CHANNEL, $request->prepareOption());
    }

    public function read(callable $callback)
    {
        $client = $this->connection->client();

        while ($this->connection->isConnected()) {
            $resource = $client->read();

            if (!empty($resource)) {
                call_user_func($callback, $resource);
            }
        }

        $this->connection->close();
    }

    public function __call($name, array $args)
    {
        $args = isset($args[0]) ? $args[0] : [];
        throw new \BadMethodCallException("Unknown method: {$name}.");
    }

}