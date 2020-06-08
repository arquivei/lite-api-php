<?php


namespace Arquivei\LiteApi\Sdk\Dependencies;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class HttpGuzzleAdapter implements HttpInterface
{
    private /** Client */ $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get(string $method, string $host, string $endpoint, array $options = array()): array
    {
        try {
            $uri = function ($host, $endpoint, $options) {
                $len = strlen($host);
                if ($host[$len - 1] == "/" || $host[$len - 1] == "\\") {
                    $host = substr($host, 0, $len - 1);
                }

                $len = strlen($endpoint);
                if ($endpoint[$len - 1] == "/" || $endpoint[$len - 1] == "\\") {
                    $endpoint = substr($endpoint, 0, $len - 1);
                }

                if (isset($options['parameters']) && !empty($options['parameters'])) {
                    return sprintf("%s/%s/?%s", $host, $endpoint, http_build_query($options['parameters']));
                }

                return sprintf("%s/%s/", $host, $endpoint);
            };

            $response = $this->client->request(
                $method,
                $uri($host, $endpoint, $options),
                [
                    'headers' => $options['headers']
                ]
            );
        } catch (\Exception $exception) {
            if ($exception instanceof ClientException) {
                $response = $exception->getResponse();
            }

            throw $exception;
        } finally {
            return json_decode($response->getBody(), true);
        }
    }
}
