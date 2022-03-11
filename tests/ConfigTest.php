<?php

namespace Arquivei\LiteApi\Sdk\Tests;

use Arquivei\LiteApi\Sdk\Config;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    public function testHasConfigNeedleMethods()
    {
        $config = new Config();

        $this->assertTrue(method_exists($config, 'getLiteApiHost'));
        $this->assertTrue(method_exists($config, 'getLiteApiEndpointConsultNFe'));
        $this->assertTrue(method_exists($config, 'getLiteApiEndpointConsultStatus'));
        $this->assertTrue(method_exists($config, 'getApiHeaderCredentialApiId'));
        $this->assertTrue(method_exists($config, 'getApiHeaderCredentialApiKey'));
        $this->assertTrue(method_exists($config, 'getApiHeaderContentType'));
    }
}
