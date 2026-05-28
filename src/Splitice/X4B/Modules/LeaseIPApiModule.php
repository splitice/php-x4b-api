<?php

namespace Splitice\X4B\Modules;

class LeaseIPApiModule extends Base\ApiModuleClient
{
    /**
     * Fetch all records matching the selector.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function all(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query('all', $selector, $data);
    }

    /**
     * Fetch a single record matching the selector.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function get(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query('get', $selector, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'LeaseIP';
    }
}
