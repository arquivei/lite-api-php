<?php

namespace Arquivei\LiteApi\Sdk\Requests;

class NFe
{
    private /** string */ $accessKey;

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function setAccessKey(string $accessKey): NFe
    {
        $this->accessKey = $accessKey;
        return $this;
    }
}
