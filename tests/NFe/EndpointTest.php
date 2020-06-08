<?php

namespace Arquivei\LiteApi\Sdk\Tests\NFe;

use Arquivei\LiteApi\Sdk\Config;
use Arquivei\LiteApi\Sdk\Dependencies\HttpInterface;
use Arquivei\LiteApi\Sdk\Endpoints\NFe;
use Arquivei\LiteApi\Sdk\Exceptions\HttpConnectionException;
use Arquivei\LiteApi\Sdk\Exceptions\UnreadableConfigException;
use PHPUnit\Framework\TestCase;

class EndpointTest extends TestCase
{
    public function testIsSuccessfullyResponseFlow()
    {

        $httpConnection = $this->createMock(HttpInterface::class);
        $httpConnection->expects($this->once())->method('get')->willReturn(
            json_decode(
                '{
                          "status": {
                               "code": 200,
                               "message": "string"
                          },
                          "data": {
                               "xml": "string"
                          }
                      }'
            , true)
        );

        $request = (new \Arquivei\LiteApi\Sdk\Requests\NFe())
            ->setAccessKey("string");

        $nfe = new NFe();
        $response = $nfe->execute($httpConnection, $request, (new Config()));

        $this->assertInstanceOf(\Arquivei\LiteApi\Sdk\Responses\NFe::class, $response);
        $this->assertInstanceOf(\Arquivei\LiteApi\Sdk\Responses\NFe\IsSuccess::class, $response->getResponse());

        $this->assertTrue(method_exists($response->getResponse(),'getXml'));

        $this->assertEquals(200, $response->getStatus()->getCode());
        $this->assertEquals("string", $response->getStatus()->getMessage());
        $this->assertEquals("string", $response->getResponse()->getXml());
    }

    public function testIsNotSuccessfullyResponseFlow()
    {

        $httpConnection = $this->createMock(HttpInterface::class);
        $httpConnection->expects($this->once())->method('get')->willReturn(
            json_decode(
                '{
                          "status": {
                            "code": 500,
                            "message": "string"
                          },
                          "errors": "string"
                       }'
                , true)
        );

        $request = (new \Arquivei\LiteApi\Sdk\Requests\NFe())
            ->setAccessKey("string");

        $nfe = new NFe();
        $response = $nfe->execute($httpConnection, $request, (new Config()));

        $this->assertInstanceOf(\Arquivei\LiteApi\Sdk\Responses\NFe::class, $response);
        $this->assertInstanceOf(\Arquivei\LiteApi\Sdk\Responses\NFe\IsError::class, $response->getResponse());

        $this->assertTrue(method_exists($response->getResponse(),'getError'));

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

        $request = (new \Arquivei\LiteApi\Sdk\Requests\NFe())
            ->setAccessKey("string");

        $nfe = new NFe();
        $nfe->execute($httpConnection, $request, (new Config()));
    }

    public function testExpectUnreadableException()
    {
        $this->expectException(UnreadableConfigException::class);

        $httpConnection = $this->createMock(HttpInterface::class);

        $request = (new \Arquivei\LiteApi\Sdk\Requests\NFe())
            ->setAccessKey("string");

        $config = $this->createMock(Config::class);
        $config->expects($this->once())
            ->method('getLiteApiHost')
            ->willThrowException(new UnreadableConfigException());

        $nfe = new NFe();
        $nfe->execute($httpConnection, $request, $config);
    }
}
