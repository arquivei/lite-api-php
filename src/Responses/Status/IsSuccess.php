<?php

namespace Arquivei\LiteApi\Sdk\Responses\Status;

use Arquivei\LiteApi\Sdk\Responses\BehaviorInterface;

class IsSuccess implements BehaviorInterface
{
    private /** string */ $accessKey;
    private /** string */ $status;

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function setAccessKey(string $accessKey): IsSuccess
    {
        $this->accessKey = $accessKey;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): IsSuccess
    {
        $this->status = $status;
        return $this;
    }
}
