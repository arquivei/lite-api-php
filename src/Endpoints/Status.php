<?php

namespace Arquivei\LiteApi\Sdk\Endpoints;

use Arquivei\LiteApi\Sdk\Config;
use Arquivei\LiteApi\Sdk\Dependencies\HttpInterface;
use Arquivei\LiteApi\Sdk\Requests\Status as StatusRequest;
use Arquivei\LiteApi\Sdk\Factories\Responses\StatusFactory;

class Status
{
    public function execute(
        HttpInterface $httpConnection,
        StatusRequest $statusRequest,
        Config $config
    ): \Arquivei\LiteApi\Sdk\Responses\Status {
        try {
            $httpResponse = $httpConnection->get(
                "GET",
                $config->getLiteApiHost(),
                $config->getLiteApiEndpointConsultStatus(),
                [
                    "headers" => [
                        'x-api-id' => $config->getApiHeaderCredentialApiId(),
                        'x-api-key' => $config->getApiHeaderCredentialApiKey(),
                        'content-type' => $config->getApiHeaderContentType()
                    ],
                    "parameters" => [
                        'access_key' => $statusRequest->getAccessKey()
                    ]
                ]
            );

            return (new StatusFactory)->createFromArray($httpResponse);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
