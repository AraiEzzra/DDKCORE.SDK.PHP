<?php

namespace DDKTest;


use \DDK\SDK;
use \DDK\Client\Connection;
use \PHPUnit\Framework\TestCase;

class SDKTest extends TestCase
{
    private $subject;

    public function initTest()
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
    public function connectionTest()
    {
        $connection = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->assertNotEmpty($connection);
    }

}
