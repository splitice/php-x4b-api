<?php

namespace Splitice\X4B\Modules;

use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Exceptions\ApiException;

class AclApiModule extends Base\CrudApiModule
{
    private string $target;

    public function __construct(IX4BApiClient $api, ?IX4BApiAuthorization $auth, string $target)
    {
        $this->target = $target;
        parent::__construct($api, $auth);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    protected function api_execute(string $module, string $method, array $data): mixed
    {
        $data['acl_type'] = $this->target;

        return parent::api_execute($module, $method, $data);
    }

    protected function module_name(): string
    {
        return 'ACL';
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

        return $this->api_execute($this->module_name(), __FUNCTION__, ['query' => $selector]);
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

        return $this->api_execute($this->module_name(), __FUNCTION__, ['query' => $selector]);
    }
}
