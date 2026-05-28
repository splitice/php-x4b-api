<?php

namespace Splitice\X4B\Modules\Base;

abstract class QueryApiModule extends ApiModuleClient
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
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
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
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Describe the API surface for the module.
     *
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function describe(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }
}
