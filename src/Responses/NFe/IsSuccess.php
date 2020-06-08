<?php

namespace Arquivei\LiteApi\Sdk\Responses\NFe;

use Arquivei\LiteApi\Sdk\Responses\BehaviorInterface;

class IsSuccess implements BehaviorInterface
{
    private /** string */ $xml;

    public function getXml(): string
    {
        return $this->xml;
    }

    public function setXml(string $xml): IsSuccess
    {
        $this->xml = $xml;
        return $this;
    }
}
