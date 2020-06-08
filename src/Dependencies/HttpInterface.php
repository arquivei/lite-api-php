<?php

namespace Arquivei\LiteApi\Sdk\Dependencies;

interface HttpInterface
{
    public function get(
        string $method,
        string $host,
        string $endpoint,
        array $options = array() // Accept: [ "headers"=>[], "parameters"=>[] ]
    ): array;
}
