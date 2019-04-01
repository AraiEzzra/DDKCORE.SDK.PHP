<?php

namespace DDK\Client;

use DDK\API\Channel;
use DDK\API\Request;
use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version0X;
use ElephantIO\Engine\SocketIO\Version1X;
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
        if (!strpos($host, '://')) {
            $host =  "http://" . $host;
        }

        $this->url = sprintf('%s:%s', $host, $port);

        UrlValidator::validate($this->url);

        try {
            $socketIOVersion = new Version2X($this->url);
            $this->client = new Client($socketIOVersion);
            $this->client->initialize();

        } catch (ServerConnectionFailureException $ex) {
            throw new ServerConnectionFailureException('Server connection to "'.$this->url.'" is failed');
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
    public function client(): Client
    {
        return $this->client;
    }

    public function clientEmitEvent($channel, Request $request = null)
    {
        $this->client->emit($channel, $request ? $request->prepareOption() : []);
    }

    /**
     * Close connection
     */
    public function close()
    {
        $this->client->close();
        $this->connected = false;
    }

    public function isConnected(): bool
    {
        return $this->connected;
    }

}