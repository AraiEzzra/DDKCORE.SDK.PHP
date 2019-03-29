<?php

namespace DDK;


use DDK\API\Channel;
use DDK\API\Filter;
use DDK\API\Method;
use DDK\API\Request;
use DDK\API\Response;
use DDK\API\Sort;
use DDK\Client\Connection;
use DDK\Crypto\Bip39;
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
        $this->connection->clientEmitEvent(Channel::MESSAGE_CHANNEL, $request);
    }

    public function read(callable $callback)
    {
        $client = $this->connection->client();

        while ($this->connection->isConnected()) {
            $resource = $client->read();
            $response = new Response($resource);

            if (!empty($resource) AND $response->validate()) {
                call_user_func($callback, $response->data());
            }
        }

        $this->connection->close();
    }

    /**
     * @param $address string|number Address of account
     */
    public function getAccount($address)
    {
        $this->request(Method::GET_ACCOUNT,
            [
                'address' => $address,
            ]
        );
    }

    /**
     * @param $address string Address of account
     */
    public function getAccountBalance($address)
    {
        $this->request(Method::GET_ACCOUNT_BALANCE,
            [
                'address' => $address,
            ]
        );
    }

    /**
     * Retrieve transaction by ID
     *
     * @param $id string Transaction ID
     */
    public function getTransaction($id)
    {
        $this->request(Method::GET_TRANSACTION,
            [
                'id' => $id,
            ]
        );
    }

    /**
     * Retrieve transactions with filter `limit, offset` and sortering params
     *
     * @param int $limit
     * @param int $offset
     * @param array $sort
     * @param array $filter
     */
    public function getTransactions($limit = 10, $offset = 0, $sort = [], $filter = [])
    {
        if ($sort instanceof Sort)
            $sort = $sort->values();

        if ($filter instanceof Filter)
            $filter = $filter->values();

        $this->request(Method::GET_TRANSACTIONS,
            [
                'limit' => $limit,
                'offset' => $offset,
                'sort' => $sort,
                'filter' => $filter,
            ]
        );
    }

    /**
     * Retrieve transaction by Block ID
     *
     * @param $blockId string block id
     * @param int $limit
     * @param int $offset
     */
    public function getTransactionsByBlockId($blockId, $limit = 10, $offset = 0)
    {
        $this->request(Method::GET_TRANSACTIONS_BY_BLOCK_ID,
            [
                'blockId' => $blockId,
                'limit' => $limit,
                'offset' => $offset,
            ]
        );
    }

    /**
     * Return passpharse from bitcore-mnemonic
     *
     * @return string
     */
    public function createPasspharse()
    {
        return (new Bip39())->generate();
    }

    /**
     * @param $address string
     */
    public function createAccount($address)
    {
        $this->request(Method::CREATE_ACCOUNT,
            [
                'address' => $address,
            ]
        );
    }

    /**
     * @param $address string|int
     * @param $amount int
     */
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
        $channel = constant('\DDK\API\Channel::'. $event);
        $this->connection->clientEmitEvent($channel);
        $this->read($callback);
    }

}