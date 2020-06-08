<?php

namespace Arquivei\LiteApi\Sdk\Responses;

use Arquivei\LiteApi\Sdk\Responses\Http\Status;

class NFe
{
    private /** Responses/Http/Status */ $status;
    private /**  BehaviorInterface */ $response;

    public function __construct(BehaviorInterface $response)
    {
        $this->response = $response;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(Status $status): NFe
    {
        $this->status = $status;
        return $this;
    }

    public function getResponse(): BehaviorInterface
    {
        return $this->response;
    }
}
