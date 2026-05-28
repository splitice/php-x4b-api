<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\Modules\AclApiModule;
use Splitice\X4B\X4BApi;

class ACL
{
    use TCrudWrapper;

    private int|string $id;

    private X4BApi $api;

    private string $target;

    /**
     * @param array{id: int|string} $fields
     */
    public function __construct(array $fields, X4BApi $api, string $target)
    {
        $this->id = self::requireId($fields);
        $this->target = $target;
        $this->api = $api;
    }

    protected function moduleApi(): AclApiModule
    {
        return $this->api->module_acl($this->target);
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function moduleDataFilter(array &$data): void
    {
        $data['acl_type'] = $this->target;
    }

    /**
     * @return array<string, mixed>
     */
    protected function getApiValue(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getApiQuery(): array
    {
        return ['id' => $this->id];
    }

    public function moveUp(): mixed
    {
        return $this->moduleApi()->moveUp(['id' => $this->id]);
    }

    public function moveDown(): mixed
    {
        return $this->moduleApi()->moveDown(['id' => $this->id]);
    }

    public static function fromId(int|string $id, X4BApi $api, string $target): self
    {
        return new self(['id' => $id], $api, $target);
    }

    /**
     * @param array{id: int|string} $fields
     */
    private static function requireId(array $fields): int|string
    {
        return $fields['id'];
    }
}
