<?php

namespace Splitice\X4B\Modules\Base;

abstract class CrudApiModule extends QueryApiModule
{
    /**
     * Create a new record.
     *
     * @param array<string, mixed> $value Record values.
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function create(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Update an existing record.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $value Updated values.
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function update(array $selector, array $value, array $data = []): mixed
    {
        return $this->api_execute_query_value(__FUNCTION__, $selector, $value, $data);
    }

    /**
     * Delete a record.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function delete(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Execute a bulk create/update request.
     *
     * @param array<int|string, array<string, mixed>> $rows Bulk rows keyed by identifier.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function bulk(array $rows, array $data = []): mixed
    {
        return $this->api_execute_bulk($rows, $data);
    }
}
