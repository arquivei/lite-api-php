# arquivei/lite-api-php

SDK for Arquivei Lite API.

## Installation

```bash
composer require arquivei/lite-api-php
```

## How to use

#### Configuration

The first step you need to do is configure your api keys:

You need to input your credentials, all the other configurations you can keep the default.

```env
LITE_API_HOST=https://lite-api.arquivei.com.br #default value
LITE_API_ENDPOINT_CONSULT_NFE=v1/nfe #default value
LITE_API_ENDPOINT_CONSULT_STATUS=/v1/nfe/status #default value

LITE_API_HEADER_CREDENTIAL_ID=A #ENTER YOUR API ID
LITE_API_HEADER_CREDENTIAL_KEY=B #ENTER YOUT API KEY
LITE_API_HEADER_CONTENT_TYPE=application/json #default value
```

#### Using NFe Consult Endpoint

```php

require_once ('vendor/autoload.php');

$httpClient = new \Arquivei\LiteApi\Sdk\Dependencies\HttpGuzzleAdapter(new \GuzzleHttp\Client);

$nfeRequest = new Arquivei\LiteApi\Sdk\Requests\NFe();
$nfeRequest->setAccessKey("KEY");

$nfeEndpoint = new \Arquivei\LiteApi\Sdk\Endpoints\NFe();
$nfeEndpointResponse = $nfeEndpoint->execute($httpClient, $nfeRequest, new \Arquivei\LiteApi\Sdk\Config());
```

Or you can use the Facade:

```php
require_once ('vendor/autoload.php');

$liteApiFacade = new \Arquivei\LiteApi\Sdk\Facade();
$nfeEndpointResponse = $liteApiFacade->nfe("KEY");
```

#### Using Status Consult Endpoint

```php
require_once ('vendor/autoload.php');

$httpClient = new \Arquivei\LiteApi\Sdk\Dependencies\HttpGuzzleAdapter(new \GuzzleHttp\Client);

$statusRequest = new Arquivei\LiteApi\Sdk\Requests\Status();
$statusRequest->setAccessKey("KEY");

$statusEndpoint = new \Arquivei\LiteApi\Sdk\Endpoints\Status();
$statusEndpointResponse = $statusEndpoint->execute($httpClient, $statusRequest, new \Arquivei\LiteApi\Sdk\Config());

```

Or you can use the Facade:

```php
require_once ('vendor/autoload.php');

$liteApiFacade = new \Arquivei\LiteApi\Sdk\Facade();
$statusEndpointResponse = $liteApiFacade->status("KEY");
```

#### Tests

Run unit tests:

```
./vendor/bin/phpunit tests/
```
