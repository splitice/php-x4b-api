<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\Modules\Base\CrudApiModule;

trait TCrudWrapper
{
    abstract protected function moduleApi(): CrudApiModule;

    /**
     * @param array<string, mixed> $data
     */
    abstract protected function moduleDataFilter(array &$data): void;

    /**
     * @return array<string, mixed>
     */
    abstract protected function getApiValue(): array;

    /**
     * @return array<string, mixed>
     */
    abstract protected function getApiQuery(): array;

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function insert(array $data = []): mixed
    {
        $this->moduleDataFilter($data);

        return $this->moduleApi()->insert($this->getApiValue(), $data);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function delete(array $data = []): mixed
    {
        $this->moduleDataFilter($data);

        return $this->moduleApi()->delete($this->getApiQuery(), $data);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function update(array $data = []): mixed
    {
        $this->moduleDataFilter($data);

        return $this->moduleApi()->update($this->getApiQuery(), $this->getApiValue(), $data);
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function get(array $data = []): mixed
    {
        $this->moduleDataFilter($data);

        return $this->moduleApi()->get($this->getApiQuery(), $data);
    }
}
