<?php

namespace Splitice\X4B\Modules;

class L7ListApiModule extends Base\QueryApiModule
{
    /**
     * Create a new list entry.
     *
     * @param array<string, mixed> $value Entry values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function create(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Delete an existing list entry.
     *
     * @param array<string, mixed> $value Entry values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function delete(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Add an entry to the list.
     *
     * @param array<string, mixed> $value Entry values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function add(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Remove an entry from the list.
     *
     * @param array<string, mixed> $value Entry values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function remove(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'L7List';
    }
}
