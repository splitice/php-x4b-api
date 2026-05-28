<?php

namespace Splitice\X4B\Modules;

class FirewallProfileApiModule extends Base\QueryApiModule
{
    /**
     * Update an existing record.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $value Updated values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function update(array $selector, array $value, array $data = []): mixed
    {
        return $this->api_execute_query_value(__FUNCTION__, $selector, $value, $data);
    }

    /**
     * Execute a bulk update request.
     *
     * @param array<int|string, array<string, mixed>> $rows Bulk rows keyed by identifier.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function bulk(array $rows, array $data = []): mixed
    {
        return $this->api_execute_bulk($rows, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'FirewallProfile';
    }
}
