<?php

namespace Arquivei\LiteApi\Sdk\Requests;

class Status
{
    private /** string */ $accessKey;

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function setAccessKey(string $accessKey): Status
    {
        $this->accessKey = $accessKey;
        return $this;
    }
}
