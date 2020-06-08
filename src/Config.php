<?php

namespace Arquivei\LiteApi\Sdk;

use Arquivei\LiteApi\Sdk\Exceptions\UnreadableConfigException;

class Config
{

    private /** closure */ $env;

    public function __construct()
    {
        $this->env = function (string $key) {
            $value = getenv($key);
            if (empty($value) || is_null($value)) {
                throw new UnreadableConfigException();
            }
            return $value;
        };
    }

    public function getLiteApiHost(): string
    {
        return ($this->env)("LITE_API_HOST");
    }

    public function getLiteApiEndpointConsultNFe(): string
    {
        return ($this->env)("LITE_API_ENDPOINT_CONSULT_NFE");
    }

    public function getLiteApiEndpointConsultStatus(): string
    {
        return ($this->env)("LITE_API_ENDPOINT_CONSULT_STATUS");
    }

    public function getApiHeaderCredentialApiId(): string
    {
        return ($this->env)("LITE_API_HEADER_CREDENTIAL_ID");
    }

    public function getApiHeaderCredentialApiKey(): string
    {
        return ($this->env)("LITE_API_HEADER_CREDENTIAL_KEY");
    }

    public function getApiHeaderContentType(): string
    {
        return ($this->env)("LITE_API_HEADER_CONTENT_TYPE");
    }
}
