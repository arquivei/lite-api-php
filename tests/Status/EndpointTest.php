<?php

namespace Arquivei\LiteApi\Sdk\Tests\Status;

use Arquivei\LiteApi\Sdk\Config;
use Arquivei\LiteApi\Sdk\Dependencies\HttpInterface;
use Arquivei\LiteApi\Sdk\Endpoints\Status;
use Arquivei\LiteApi\Sdk\Exceptions\HttpConnectionException;
use Arquivei\LiteApi\Sdk\Exceptions\UnreadableConfigException;
use Arquivei\LiteApi\Sdk\Requests\Status as StatusRequest;
use Arquivei\LiteApi\Sdk\Responses\Status as StatusResponse;
use PHPUnit\Framework\TestCase;

class EndpointTest extends TestCase
{
    public function testIsSuccessfullyResponseFlow()
    {
        $httpConnection = $this->createMock(HttpInterface::class);
        $httpConnection
            ->expects($this->once())
            ->method('get')
            ->willReturn(
                json_decode(
                    '{"status": {"code": 200,"message": "string"},"data": {"access_key": "string","status": "string"}}',
                    true
                )
            );

        $request = (new StatusRequest())
            ->setAccessKey("string");

        $status = new Status();
        $response = $status->execute($httpConnection, $request, (new Config()));

        $this->assertInstanceOf(StatusResponse::class, $response);
        $this->assertInstanceOf(StatusResponse\IsSuccess::class, $response->getResponse());

        $this->assertTrue(method_exists($response->getResponse(), 'getAccessKey'));
        $this->assertTrue(method_exists($response->getResponse(), 'getStatus'));

        $this->assertEquals(200, $response->getStatus()->getCode());
        $this->assertEquals("string", $response->getStatus()->getMessage());
        $this->assertEquals("string", $response->getResponse()->getAccessKey());
        $this->assertEquals("string", $response->getResponse()->getStatus());
    }

    public function testIsNotSuccessfullyResponseFlow()
    {
        $httpConnection = $this->createMock(HttpInterface::class);
        $httpConnection
            ->expects($this->once())
            ->method('get')
            ->willReturn(json_decode('{"status": {"code": 500,"message": "string"},"error": "string"}', true));

        $request = (new StatusRequest())
            ->setAccessKey("string");

        $status = new Status();
        $response = $status->execute($httpConnection, $request, (new Config()));

        $this->assertInstanceOf(StatusResponse::class, $response);
        $this->assertInstanceOf(StatusResponse\IsError::class, $response->getResponse());

        $this->assertTrue(method_exists($response->getResponse(), 'getError'));

        $this->assertEquals(500, $response->getStatus()->getCode());
        $this->assertEquals("string", $response->getStatus()->getMessage());
        $this->assertEquals("string", $response->getResponse()->getError());
    }

    public function testExpectHtpConnectionException()
    {
        $this->expectException(HttpConnectionException::class);

        $httpConnection = $this->createMock(HttpInterface::class);

        $httpConnection->expects($this->once())
            ->method('get')
            ->willThrowException(new HttpConnectionException());

        $request = (new StatusRequest())
            ->setAccessKey("string");

        $status = new Status();
        $status->execute($httpConnection, $request, (new Config()));
    }

    public function testExpectUnreadableException()
    {
        $this->expectException(UnreadableConfigException::class);

        $httpConnection = $this->createMock(HttpInterface::class);

        $request = (new StatusRequest())
            ->setAccessKey("string");

        $config = $this->createMock(Config::class);
        $config->expects($this->once())
            ->method('getLiteApiHost')
            ->willThrowException(new UnreadableConfigException());

        $status = new Status();
        $status->execute($httpConnection, $request, $config);
    }
}
