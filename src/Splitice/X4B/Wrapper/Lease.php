<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class Lease
{
    private int|string $id;

    private X4BApi $api;

    /**
     * @param array{id: int|string} $fields
     */
    public function __construct(array $fields, X4BApi $api)
    {
        $this->id = self::requireId($fields);
        $this->api = $api;
    }

    /**
     * @return list<Port>
     */
    public function getPorts(): array
    {
        $records = $this->api->module_port()->all(['lease' => $this->id]);
        $ports = [];

        if (!is_array($records)) {
            return $ports;
        }

        foreach ($records as $record) {
            if (is_array($record) && isset($record['id']) && (is_int($record['id']) || is_string($record['id']))) {
                $ports[] = Port::fromId($record['id'], $this->api);
            }
        }

        return $ports;
    }

    public static function fromId(int|string $id, X4BApi $api): self
    {
        return new self(['id' => $id], $api);
    }

    /**
     * @param array{id: int|string} $fields
     */
    private static function requireId(array $fields): int|string
    {
        return $fields['id'];
    }
}
