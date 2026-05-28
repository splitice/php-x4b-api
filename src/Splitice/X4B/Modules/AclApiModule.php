<?php

namespace Splitice\X4B\Modules;

use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Exceptions\ApiException;

class AclApiModule extends Base\CrudApiModule
{
    private string $target;

    /**
     * @param IX4BApiClient $api API transport client.
     * @param IX4BApiAuthorization|null $auth Optional authorization strategy.
     * @param string $target ACL target type.
     */
    public function __construct(IX4BApiClient $api, ?IX4BApiAuthorization $auth, string $target)
    {
        $this->target = $target;
        parent::__construct($api, $auth);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    protected function api_execute(string $method, array $data = []): mixed
    {
        $data['acl_type'] = $this->target;

        return parent::api_execute($method, $data);
    }

    /**
     * Get the legacy ACL module name.
     */
    protected function module_name(): string
    {
        return 'ACL';
    }

    /**
     * Legacy synonym for `create()`.
     *
     * @param array<string, mixed> $value
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function insert(array $value, array $data = []): mixed
    {
        return $this->create($value, $data);
    }

    /**
     * @param array<string, mixed> $selector
     * @return mixed
     */
    public function moveUp(array $selector): mixed
    {
        if ($this->target !== 'http') {
            throw new ApiException(__FUNCTION__ . ' is only valid on http type ACLs');
        }

        return $this->api_execute_query('move_up', $selector);
    }

    /**
     * @param array<string, mixed> $selector
     * @return mixed
     */
    public function moveDown(array $selector): mixed
    {
        if ($this->target !== 'http') {
            throw new ApiException(__FUNCTION__ . ' is only valid on http type ACLs');
        }

        return $this->api_execute_query('move_down', $selector);
    }
}
