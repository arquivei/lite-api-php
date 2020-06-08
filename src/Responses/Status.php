<?php

namespace Arquivei\LiteApi\Sdk\Responses;

use Arquivei\LiteApi\Sdk\Responses\Http\Status as HttpStatus;

class Status
{
    private /** HttpStatus */ $status;
    private /**  BehaviorInterface */ $response;

    public function __construct(BehaviorInterface $response)
    {
        $this->response = $response;
    }

    public function getStatus(): HttpStatus
    {
        return $this->status;
    }

    public function setStatus(HttpStatus $status): Status
    {
        $this->status = $status;
        return $this;
    }

    public function getResponse(): BehaviorInterface
    {
        return $this->response;
    }
}
