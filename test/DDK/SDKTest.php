<?php

namespace DDKTest;


use DDK\API\Method;
use DDK\API\Request;
use DDK\Client\Connection;
use DDK\SDK;
use PHPUnit\Framework\TestCase;

class SDKTest extends TestCase
{
    private $subject;

    public function testInitClassSDK()
    {
        $connectionConfig = [
            'host' => '127.0.0.1',
            'port' => 8000,
        ];

        $this->subject = new SDK($connectionConfig);
    }

    /**
     * @test
     */
    public function testConnection()
    {
    }

    /**
     * @dataProvider testRequestAPIMethods
     */
    public function testRequest (string $method, array $option)
    {
        $request = new Request($method, $option);
        $prepareData = $request->prepareOption();
        $prepareDataObject = $prepareData[0];

        $this->assertArrayHasKey('headers', $prepareDataObject,
            'Request prepare data not have key: headers; in method: ' . $method);

        $this->assertArrayHasKey('body', $prepareDataObject,
            'Request prepare data not have key: body; in method: ' . $method);

        $this->assertArrayHasKey('code', $prepareDataObject,
            'Request prepare data not have key: body; in method: ' . $method);

        $this->assertEquals($prepareDataObject['code'], $method);
    }

    public function testRequestAPIMethods ()
    {
        return [
            'GET_ACCOUNT' => [Method::GET_ACCOUNT, []],
            'GET_ACCOUNT_BALANCE' => [Method::GET_ACCOUNT_BALANCE, []],
            'GET_TRANSACTION' => [Method::GET_TRANSACTION, []],
            'GET_TRANSACTIONS_BY_BLOCK_ID' => [Method::GET_TRANSACTIONS_BY_BLOCK_ID, []],
            'GET_TRANSACTIONS' => [Method::GET_TRANSACTIONS, []],
            'CREATE_ACCOUNT' => [Method::CREATE_ACCOUNT, []],
            'SEND' => [Method::SEND, []],
        ];
    }

    /**
     * @dataProvider testFakeRequestAPIMethods
     */
    public function testFakeRequest ($method, $option)
    {
        $request = new Request(Method::GET_ACCOUNT);
    }

    public function testFakeRequestAPIMethods ()
    {
        return [
            'CREATE_ADDRESS' => [Method::CREATE_ADDRESS, []],
            'SUBSCRIBE' => [Method::SUBSCRIBE, []],
        ];
    }

}
