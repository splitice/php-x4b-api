<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\Modules\Base\CrudApiModule;
use Splitice\X4B\X4BApi;
use UnexpectedValueException;

class ACL extends AbstractRecordWrapper
{
    use TCrudWrapper;

    private string $target;

    private int|string|null $portId;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields, X4BApi $api, string $target = '', int|string|null $portId = null)
    {
        parent::__construct($fields, $api);
        if ($target === '') {
            throw new UnexpectedValueException('ACL target is required.');
        }

        $this->target = $target;
        $this->portId = $portId;
        if (isset($fields['port']) && (is_int($fields['port']) || is_string($fields['port']))) {
            $this->portId = $fields['port'];
        }
    }

    public static function fromId(
        int|string $id,
        X4BApi $api,
        string $target,
        int|string|null $portId = null
    ): static {
        return new static(['id' => $id], $api, $target, $portId);
    }

    /**
     * @param array<string, mixed> $record
     */
    public static function fromRecord(
        array $record,
        X4BApi $api,
        string $target,
        int|string|null $portId = null
    ): static {
        return new static($record, $api, $target, $portId);
    }

    /**
     * @return array<string, mixed>
     */
    protected function loadData(): array
    {
        /** @var array<string, mixed> $record */
        $record = $this->api()->module_acl($this->target)->get($this->getApiQuery());

        return $record;
    }

    protected function moduleApi(): CrudApiModule
    {
        return $this->api()->module_acl($this->target);
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
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        return $query;
    }

    public function getTarget(): string
    {
        return $this->target;
    }

    public function getMask(): ?string
    {
        return $this->getStringField('mask');
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function getOrder(): mixed
    {
        return $this->getField('order');
    }

    public function getPort(): ?Port
    {
        if ($this->portId === null) {
            return null;
        }

        return Port::fromId($this->portId, $this->api());
    }

    /**
     * @param array<string, mixed> $value
     */
    public function updateFields(array $value): mixed
    {
        $result = $this->api()->module_acl($this->target)->update($this->getApiQuery(), $value);
        $this->invalidate();

        return $result;
    }

    public function moveUp(): mixed
    {
        $result = $this->api()->module_acl($this->target)->moveUp($this->getApiQuery());
        $this->invalidate();

        return $result;
    }

    public function moveDown(): mixed
    {
        $result = $this->api()->module_acl($this->target)->moveDown($this->getApiQuery());
        $this->invalidate();

        return $result;
    }
}
