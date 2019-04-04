<?php

namespace DDK;

ini_set("default_socket_timeout", -1);

use DDK\API\Channel;
use DDK\API\Filter;
use DDK\API\Method;
use DDK\API\Request;
use DDK\API\Response;
use DDK\API\Schemas\CreateTransactionAsset;
use DDK\API\Sort;
use DDK\API\TransactionType;
use DDK\Client\Connection;
use DDK\Crypto\Bip39;
use DDK\Validation\ArrayKeysValidator;
use DDK\Crypto\KeyPair;


const SDK_REQUIRED_OPTIONS = [
    'host',
    'port'
];

class SDK
{

    /**
     * SDK version
     */
    const VERSION = '0.0.4';

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

    public function request($method, array $bodyOptions = [], string $code = null)
    {
        $request = new Request($method, $bodyOptions, $code);
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
                'filter' => (object) $filter,
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
        return Bip39::generate();
    }

    public function createAccount()
    {
        $secret = $this->createPasspharse();

        // TODO: When will fix CORE API change that type to TransactionType::REGISTER
        $type = TransactionType::SEND;
        $this->createTransaction($secret, $type, [
            "amount" => 100000,
            "recipientAddress" => "99999999999999999999"
        ]);
    }

    /**
     * @param string $secret
     * @param int $type
     * @param array $asset
     */
    public function createTransaction(string $secret, int $type, array $asset = [])
    {
        $publickey = KeyPair::makePublickey($secret);
        $this->request(Method::CREATE_TRANSACTION,
            [
                'secret' => $secret,
                'trs' => [
                    'senderPublicKey' => $publickey,
                    'type' => $type,
                    'asset' => $asset ? $asset : new \stdClass(),
                ],
            ]
        );
    }

    /**
     * @param $secret
     * @param $recipientAddress
     * @param $amount
     */
    public function send(string $secret, string $recipientAddress, int $amount)
    {
        $publickey = KeyPair::makePublickey($secret);
        $this->request(Method::CREATE_TRANSACTION,
            [
                'secret' => $secret,
                'trs' => [
                    'senderPublicKey' => $publickey,
                    'type' => TransactionType::SEND,
                    'asset' => [
                        'recipientAddress' => $recipientAddress,
                        'amount' => $amount,
                    ]
                ],
            ]
        );
    }

    public function subscribe($event, Callable $callback)
    {
        $channel = constant('\DDK\API\Channel::'. $event);
        $this->connection->clientEmitEvent($channel);
        $this->read($callback);
    }

}