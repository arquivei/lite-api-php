<?php

namespace Arquivei\LiteApi\Sdk;

use Arquivei\LiteApi\Sdk\Dependencies\HttpGuzzleAdapter;
use Arquivei\LiteApi\Sdk\Endpoints;
use Arquivei\LiteApi\Sdk\Requests;
use GuzzleHttp\Client;

class Facade
{
    public function nfe(string $accessKey): Responses\NFe
    {
        $httpClient = new HttpGuzzleAdapter(new Client());

        $nfeRequest = new Requests\NFe();
        $nfeRequest->setAccessKey($accessKey);

        $nfeEndpoint = new Endpoints\NFe();

        return $nfeEndpoint->execute($httpClient, $nfeRequest, new Config());
    }

    public function status(string $accessKey): Responses\Status
    {
        $httpClient = new HttpGuzzleAdapter(new Client());

        $statusRequest = new Requests\Status();
        $statusRequest->setAccessKey($accessKey);

        $statusEndpoint = new Endpoints\Status();
        return $statusEndpoint->execute($httpClient, $statusRequest, new Config());
    }
}
