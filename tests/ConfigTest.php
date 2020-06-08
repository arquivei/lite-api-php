<?php

use Arquivei\LiteApi\Sdk\Tests;

class ConfigTest extends \PHPUnit\Framework\TestCase
{
    public function testHasConfigNeedleMethods()
    {
        $config = new \Arquivei\LiteApi\Sdk\Config();

        $this->assertTrue(method_exists($config, 'getLiteApiHost'));
        $this->assertTrue(method_exists($config, 'getLiteApiEndpointConsultNFe'));
        $this->assertTrue(method_exists($config, 'getLiteApiEndpointConsultStatus'));
        $this->assertTrue(method_exists($config, 'getApiHeaderCredentialApiId'));
        $this->assertTrue(method_exists($config, 'getApiHeaderCredentialApiKey'));
        $this->assertTrue(method_exists($config, 'getApiHeaderContentType'));
    }
}
