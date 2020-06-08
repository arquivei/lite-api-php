<?php

namespace Arquivei\LiteApi\Sdk\Responses\NFe;

use Arquivei\LiteApi\Sdk\Responses\BehaviorInterface;

class IsError implements BehaviorInterface
{
    private /** string */ $error;

    public function getError(): string
    {
        return $this->error;
    }

    public function setError(string $error): IsError
    {
        $this->error = $error;
        return $this;
    }
}
