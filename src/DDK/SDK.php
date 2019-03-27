<?php

namespace DDK;


use DDK\API\Channel;
use DDK\API\Filter;
use DDK\API\Method;
use DDK\API\Request;
use DDK\API\Sort;
use DDK\Client\Connection;
use DDK\Validation\ArrayKeysValidator;


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

    public function getAccount($address)
    {
        $this->request(Method::GET_ACCOUNT,
            [
                'address' => $address,
            ]
        );
    }

    public function getAccountBalance($address)
    {
        $this->request(Method::GET_ACCOUNT_BALANCE,
            [
                'address' => $address,
            ]
        );
    }

    public function getTransaction($id)
    {
        $this->request(Method::GET_TRANSACTION,
            [
                'id' => $id,
            ]
        );
    }

    public function getTransactions(Filter $filter, Sort $sort, $limit = 10, $offset = 0)
    {

        $this->request(Method::GET_TRANSACTIONS,
            [
                'filter' => $filter,
                'sort' => $sort,
                'limit' => $limit,
                'offset' => $offset,
            ]
        );
    }

    public function createAddress()
    {
        return 'BIP39 will generate';
    }

    public function createAccount($address)
    {
        $this->request(Method::CREATE_ACCOUNT,
            [
                'address' => $address,
            ]
        );
    }

    public function send($address, $amount)
    {
        $this->request(Method::SEND,
            [
                'address' => $address,
                'amount' => $amount,
            ]
        );
    }

    public function subscribe($event, callback $callback)
    {
        // todo: $this->connection->send();
        $channel= constant('\DDK\API\Channel::'. $event);

        $client = $this->connection->client();
        $client->emit($channel, []);

        $this->read($callback);
    }

}