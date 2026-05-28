<?php

namespace Splitice\X4B\Modules;

class ServiceApiModule extends Base\ApiModuleClient
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
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'Service';
    }
}
