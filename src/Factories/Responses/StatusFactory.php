<?php

namespace Arquivei\LiteApi\Sdk\Factories\Responses;

use Arquivei\LiteApi\Sdk\Responses\Http\Status as HttpStatus;
use Arquivei\LiteApi\Sdk\Responses\Status;

class StatusFactory
{
    public function createFromArray(array $httpResponse): Status
    {
        if ($httpResponse['status']['code'] == 200) {
            $statusSuccessfullyResponse = new Status(new Status\IsSuccess());

            $statusSuccessfullyResponse->setStatus(
                (new HttpStatus())
                    ->setCode($httpResponse['status']['code'])->setMessage($httpResponse['status']['message'])
            );

            $statusSuccessfullyResponse->getResponse()->setAccessKey($httpResponse['data']['access_key']);
            $statusSuccessfullyResponse->getResponse()->setStatus($httpResponse['data']['status']);

            return $statusSuccessfullyResponse;
        }

        $statusErrorResponse = new Status(new Status\IsError());

        $statusErrorResponse->setStatus(
            (new HttpStatus())
                ->setCode($httpResponse['status']['code'])->setMessage($httpResponse['status']['message'])
        );
        $statusErrorResponse->getResponse()->setError($httpResponse['error']);

        return $statusErrorResponse;
    }
}
