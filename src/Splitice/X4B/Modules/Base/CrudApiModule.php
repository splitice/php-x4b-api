<?php

namespace Splitice\X4B\Modules\Base;

abstract class CrudApiModule extends ApiModuleClient
{
    abstract protected function module_name(): string;

    /**
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function all(array $selector, array $data = []): mixed
    {
        $data['query'] = $selector;

        return $this->api_execute($this->module_name(), __FUNCTION__, $data);
    }

    /**
     * @param array<string, mixed> $value
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function insert(array $value, array $data = []): mixed
    {
        $data['value'] = $value;

        return $this->api_execute($this->module_name(), __FUNCTION__, $data);
    }

    /**
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $value
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function update(array $selector, array $value, array $data = []): mixed
    {
        $data['query'] = $selector;
        $data['value'] = $value;

        return $this->api_execute($this->module_name(), __FUNCTION__, $data);
    }

    /**
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function get(array $selector, array $data = []): mixed
    {
        $data['query'] = $selector;

        return $this->api_execute($this->module_name(), __FUNCTION__, $data);
    }

    /**
     * @param array<string, mixed> $selector
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function delete(array $selector, array $data = []): mixed
    {
        $data['query'] = $selector;

        return $this->api_execute($this->module_name(), __FUNCTION__, $data);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function describe(array $data = []): mixed
    {
        return $this->api_execute($this->module_name(), __FUNCTION__, $data);
    }
}
