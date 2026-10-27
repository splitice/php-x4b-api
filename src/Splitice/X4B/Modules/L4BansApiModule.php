<?php

namespace Splitice\X4B\Modules;

/** Customer Layer 4 ban management; rows are listed by LeaseIP. */
class L4BansApiModule extends Base\ApiModuleClient
{
    /**
     * List active bans for the selected LeaseIP.
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function all(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Ban addresses in the selected announcable regions.
     * @param array<string, mixed> $value
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function ban(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Unban an address in one announcable region.
     * @param array<string, mixed> $value
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function unban(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Describe ban parameters and response schemas.
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function describe(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /** Return the canonical customer API module name. */
    protected function module_name(): string
    {
        return 'L4Bans';
    }
}
