<?php

namespace Splitice\X4B\Modules;

class Layer7RuleApiModule extends Base\CrudApiModule
{
    /**
     * Return authorized per-rule traffic counts for a port.
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function hits(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Create a drop rule.
     *
     * @param array<string, mixed> $value Rule values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function create_drop(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Create a rate blacklist rule.
     *
     * @param array<string, mixed> $value Rule values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function create_rate_blacklist(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Create a rate whitelist rule.
     *
     * @param array<string, mixed> $value Rule values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function create_rate_whitelist(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'Layer7Rule';
    }
}
