<?php


namespace Arquivei\LiteApi\Sdk\Endpoints;

use Arquivei\LiteApi\Sdk\Config;
use Arquivei\LiteApi\Sdk\Dependencies\HttpInterface;
use Arquivei\LiteApi\Sdk\Requests\NFe as NFeRequest;
use Arquivei\LiteApi\Sdk\Factories\Responses\NFeFactory;

class NFe
{
    public function execute(
        HttpInterface $httpConnection,
        NFeRequest $nfeRequest,
        Config $config
    ): \Arquivei\LiteApi\Sdk\Responses\NFe {
        try {
            $httpResponse = $httpConnection->get(
                "GET",
                $config->getLiteApiHost(),
                $config->getLiteApiEndpointConsultNFe(),
                [
                    "headers" => [
                        'x-api-id' => $config->getApiHeaderCredentialApiId(),
                        'x-api-key' => $config->getApiHeaderCredentialApiKey(),
                        'content-type' => $config->getApiHeaderContentType()
                    ],
                    "parameters" => [
                        'access_key' => $nfeRequest->getAccessKey()
                    ]
                ]
            );

            return (new NFeFactory)->createFromArray($httpResponse);
        } catch (\Exception $exception) {
            throw $exception;
        }
    }
}
