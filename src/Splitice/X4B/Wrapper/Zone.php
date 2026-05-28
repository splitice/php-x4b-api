<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class Zone extends AbstractRecordWrapper
{
    private int|string|null $portId;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields, X4BApi $api, int|string|null $portId = null)
    {
        parent::__construct($fields, $api);
        $this->portId = $portId;
        if (isset($fields['port']) && (is_int($fields['port']) || is_string($fields['port']))) {
            $this->portId = $fields['port'];
        }
    }

    public static function fromId(int|string $id, X4BApi $api, int|string|null $portId = null): static
    {
        return new static(['id' => $id], $api, $portId);
    }

    /**
     * @param array<string, mixed> $record
     */
    public static function fromRecord(array $record, X4BApi $api, int|string|null $portId = null): static
    {
        return new static($record, $api, $portId);
    }

    /**
     * @return array<string, mixed>
     */
    protected function loadData(): array
    {
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        /** @var array<string, mixed> $record */
        $record = $this->api()->module_zone()->get($query);

        return $record;
    }

    public function getExpr(): ?string
    {
        return $this->getStringField('expr');
    }

    public function getMode(): ?string
    {
        return $this->getStringField('mode');
    }

    public function getOrder(): mixed
    {
        return $this->getField('order');
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        $result = $this->api()->module_zone()->update($query, $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        $result = $this->api()->module_zone()->delete($query);
        $this->invalidate();

        return $result;
    }

    public function moveUp(): mixed
    {
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        $result = $this->api()->module_zone()->move_up($query);
        $this->invalidate();

        return $result;
    }

    public function moveDown(): mixed
    {
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        $result = $this->api()->module_zone()->move_down($query);
        $this->invalidate();

        return $result;
    }
}
