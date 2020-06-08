<?php

namespace Arquivei\LiteApi\Sdk\Factories\Responses;

use Arquivei\LiteApi\Sdk\Responses\Http\Status;
use Arquivei\LiteApi\Sdk\Responses\NFe;
use Arquivei\LiteApi\Sdk\Responses\NFe as NFeResponse;

class NFeFactory
{
    public function createFromArray(array $httpResponse): NFe
    {
        if ($httpResponse['status']['code'] == 200) {
            $nfeSucessfullyResponse = new NFeResponse(new NFeResponse\IsSuccess());

            $nfeSucessfullyResponse->setStatus(
                (new Status())->setCode($httpResponse['status']['code'])->setMessage($httpResponse['status']['message'])
            );

            $nfeSucessfullyResponse->getResponse()->setXml($httpResponse['data']['xml']);

            return $nfeSucessfullyResponse;
        }

        $nfeErrorResponse = new NFeResponse(new NFeResponse\IsError());

        $nfeErrorResponse->setStatus(
            (new Status())->setCode($httpResponse['status']['code'])->setMessage($httpResponse['status']['message'])
        );
        $nfeErrorResponse->getResponse()->setError($httpResponse['error']);

        return $nfeErrorResponse;
    }
}
