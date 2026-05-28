<?php

namespace Splitice\X4B\Modules\Base;

use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;

abstract class ApiModuleClient
{
    protected IX4BApiClient $api;

    protected ?IX4BApiAuthorization $auth;

    public function __construct(IX4BApiClient $api, ?IX4BApiAuthorization $auth = null)
    {
        $this->api = $api;
        $this->auth = $auth;
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    protected function api_execute(string $module, string $method, array $data): mixed
    {
        if ($this->auth !== null) {
            $this->auth->perform($this->api, $data);
        }

        return $this->api->execute($module, $method, $data);
    }
}
