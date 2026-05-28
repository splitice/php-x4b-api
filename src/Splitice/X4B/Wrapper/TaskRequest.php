<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class TaskRequest extends AbstractRecordWrapper
{
    private int|string|null $leaseId;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields, X4BApi $api, int|string|null $leaseId = null)
    {
        parent::__construct($fields, $api);
        $this->leaseId = $leaseId;
        if (isset($fields['lease']) && (is_int($fields['lease']) || is_string($fields['lease']))) {
            $this->leaseId = $fields['lease'];
        }
    }

    public static function fromId(int|string $id, X4BApi $api, int|string|null $leaseId = null): static
    {
        return new static(['id' => $id], $api, $leaseId);
    }

    /**
     * @param array<string, mixed> $record
     */
    public static function fromRecord(array $record, X4BApi $api, int|string|null $leaseId = null): static
    {
        return new static($record, $api, $leaseId);
    }

    /**
     * @return array<string, mixed>
     */
    protected function loadData(): array
    {
        $query = ['id' => $this->getId()];
        if ($this->leaseId !== null) {
            $query['lease'] = $this->leaseId;
        }

        /** @var array<string, mixed> $record */
        $record = $this->api()->module_task_request()->get($query);

        return $record;
    }

    public function getLease(): ?Lease
    {
        if ($this->leaseId === null) {
            return null;
        }

        return Lease::fromId($this->leaseId, $this->api());
    }

    public function getResult(): mixed
    {
        return $this->getField('result');
    }

    public function isComplete(): ?bool
    {
        return $this->getBooleanField('complete');
    }

    public function delete(): mixed
    {
        $query = ['id' => $this->getId()];
        if ($this->leaseId !== null) {
            $query['lease'] = $this->leaseId;
        }

        $result = $this->api()->module_task_request()->delete($query);
        $this->invalidate();

        return $result;
    }
}
