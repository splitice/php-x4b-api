<?php

namespace Splitice\X4B\Modules;

class TaskRequestApiModule extends Base\QueryApiModule
{
    /**
     * Create a new troubleshooting task request.
     *
     * @param array<string, mixed> $value Task request values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function create(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Delete a task request.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function delete(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'TaskRequest';
    }
}
