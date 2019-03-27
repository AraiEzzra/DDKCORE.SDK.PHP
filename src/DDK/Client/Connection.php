<?php

namespace DDK\Client;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use DDK\Validation\UrlValidator;
use ElephantIO\Exception\ServerConnectionFailureException;


class Connection
{
    /**
     * @var string
     */
    private $url;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var bool
     */
    private $connected = false;

    /**
     * Connection constructor.
     * @param $host
     * @param $port
     */
    public function __construct($host, $port)
    {
        $this->url = "$host:$port";

        if (!strpos($host, '://')) {
            $this->url =  "http://" . $this->url;
        }

        UrlValidator::validate($this->url);

        try {
            $this->client = new Client(new Version2X($this->url));
            $this->client->initialize();

        } catch (ServerConnectionFailureException $ex) {
            $this->connected = false;
        }

        $this->connected = true;

    }

    public function __destruct()
    {
        $this->close();
    }

    /**
     * @return Client
     */
    public function client()
    {
        return $this->client;
    }

    /**
     * Close connection
     */
    public function close()
    {
        $this->client->close();
        $this->connected = false;
    }

    public function isConnected()
    {
        return $this->connected;
    }

}