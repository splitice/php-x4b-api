<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class PortBackend extends AbstractRecordWrapper
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
        $record = $this->api()->module_port_backend()->get($query);

        return $record;
    }

    public function getPort(): ?Port
    {
        if ($this->portId === null) {
            return null;
        }

        return Port::fromId($this->portId, $this->api());
    }

    /**
     * @return array<string, mixed>|null
     */
    public function getTo(): ?array
    {
        return $this->getArrayField('to');
    }

    public function getBackendAddress(): ?string
    {
        $to = $this->getTo();
        if (!is_array($to) || !isset($to['addr']) || !is_scalar($to['addr'])) {
            return null;
        }

        return (string) $to['addr'];
    }

    public function getBackendPort(): mixed
    {
        $to = $this->getTo();

        return is_array($to) ? ($to['port'] ?? null) : null;
    }

    public function getTunnel(): ?Tunnel
    {
        $to = $this->getTo();
        if (!is_array($to) || !isset($to['tunnel']) || !(is_int($to['tunnel']) || is_string($to['tunnel']))) {
            return null;
        }

        return Tunnel::fromId($to['tunnel'], $this->api());
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

        $result = $this->api()->module_port_backend()->update($query, $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $query = ['id' => $this->getId()];
        if ($this->portId !== null) {
            $query['port'] = $this->portId;
        }

        $result = $this->api()->module_port_backend()->delete($query);
        $this->invalidate();

        return $result;
    }
}
