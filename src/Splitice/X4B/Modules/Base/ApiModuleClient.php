<?php

namespace Splitice\X4B\Modules\Base;

use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;

abstract class ApiModuleClient
{
    protected IX4BApiClient $api;

    protected ?IX4BApiAuthorization $auth;

    /**
     * @param IX4BApiClient $api API transport client.
     * @param IX4BApiAuthorization|null $auth Optional authorization strategy.
     */
    public function __construct(IX4BApiClient $api, ?IX4BApiAuthorization $auth = null)
    {
        $this->api = $api;
        $this->auth = $auth;
    }

    /**
     * Get the canonical API module name.
     */
    abstract protected function module_name(): string;

    /**
     * Execute a module method.
     *
     * @param string $method API method name.
     * @param array<string, mixed> $data Request payload.
     * @return mixed
     */
    protected function api_execute(string $method, array $data = []): mixed
    {
        if ($this->auth !== null) {
            $this->auth->perform($this->api, $data);
        }

        return $this->api->execute($this->module_name(), $method, $data);
    }

    /**
     * Execute an API method that accepts a `query` payload.
     *
     * @param string $method API method name.
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    protected function api_execute_query(string $method, array $selector, array $data = []): mixed
    {
        $data['query'] = $selector;

        return $this->api_execute($method, $data);
    }

    /**
     * Execute an API method that accepts a `value` payload.
     *
     * @param string $method API method name.
     * @param array<string, mixed> $value Value payload.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    protected function api_execute_value(string $method, array $value, array $data = []): mixed
    {
        $data['value'] = $value;

        return $this->api_execute($method, $data);
    }

    /**
     * Execute an API method that accepts both `query` and `value`.
     *
     * @param string $method API method name.
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $value Value payload.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    protected function api_execute_query_value(string $method, array $selector, array $value, array $data = []): mixed
    {
        $data['query'] = $selector;
        $data['value'] = $value;

        return $this->api_execute($method, $data);
    }

    /**
     * Execute an API method that accepts bulk rows.
     *
     * @param array<int|string, array<string, mixed>> $rows Bulk rows keyed by identifier.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    protected function api_execute_bulk(array $rows, array $data = []): mixed
    {
        $data['rows'] = $rows;

        return $this->api_execute('bulk', $data);
    }
}
