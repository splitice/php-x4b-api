<?php

namespace Splitice\X4B\Modules;

class SSLUserApiModule extends Base\QueryApiModule
{
    /**
     * Create a new SSL user.
     *
     * @param array<string, mixed> $value SSL user values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function create(array $value, array $data = []): mixed
    {
        return $this->api_execute_value(__FUNCTION__, $value, $data);
    }

    /**
     * Delete an SSL user.
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
     * Execute a bulk SSL user create request.
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
     * Enable an SSL user.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function enable(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Disable an SSL user.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function disable(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Group an SSL user with another.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $value Grouping values.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function group(array $selector, array $value, array $data = []): mixed
    {
        return $this->api_execute_query_value(__FUNCTION__, $selector, $value, $data);
    }

    /**
     * Force immediate retry processing for an SSL user.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function retry(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Renew an SSL user.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function renew(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Remove an SSL user from its group.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function ungroup(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Mark an SSL user as the primary certificate in its group.
     *
     * @param array<string, mixed> $selector Query selector.
     * @param array<string, mixed> $data Additional request payload.
     * @return mixed
     */
    public function setPrimary(array $selector, array $data = []): mixed
    {
        return $this->api_execute_query(__FUNCTION__, $selector, $data);
    }

    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'SSLUser';
    }
}
