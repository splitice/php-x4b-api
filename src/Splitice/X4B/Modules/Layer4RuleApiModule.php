<?php

namespace Splitice\X4B\Modules;

class Layer4RuleApiModule extends Base\CrudApiModule
{
    /**
     * Move a rule up in order.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function move_up(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Move a rule down in order.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function move_down(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Return authorized per-rule packet counts for the selected LeaseIP.
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function hits(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'Layer4Rule';
    }
}
