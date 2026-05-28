<?php

namespace Splitice\X4B\Modules;

class TunnelApiModule extends Base\CrudApiModule
{
    /**
     * Fetch the latest tunnel client versions.
     *
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function latest_versions(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Generate a tunnel script.
     *
     * @param array<string, mixed> $data Script request payload.
     * @return mixed
     */
    public function script(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Upgrade a unified tunnel.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function upgrade(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'Tunnel';
    }
}
