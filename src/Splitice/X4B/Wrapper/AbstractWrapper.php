<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;
use UnexpectedValueException;

abstract class AbstractWrapper
{
    protected X4BApi $api;

    public function __construct(X4BApi $api)
    {
        $this->api = $api;
    }

    protected function api(): X4BApi
    {
        return $this->api;
    }

    /**
     * @return list<array<string, mixed>>
     */
    protected function recordList(mixed $records): array
    {
        if (!is_array($records)) {
            return [];
        }

        $ret = [];
        foreach ($records as $record) {
            $normalized = self::normalizeRecord($record);
            if ($normalized !== null) {
                $ret[] = $normalized;
            }
        }

        return $ret;
    }

    /**
     * @return array<string, mixed>|null
     */
    protected static function normalizeRecord(mixed $record): ?array
    {
        if (!is_array($record)) {
            return null;
        }

        if ($record === []) {
            return [];
        }

        $normalized = [];
        foreach ($record as $key => $value) {
            if (is_string($key)) {
                $normalized[$key] = $value;
            }
        }

        return $normalized === [] ? null : $normalized;
    }

    /**
     * @return array<string, mixed>
     */
    protected function firstRecord(mixed $records, string $context): array
    {
        $list = $this->recordList($records);
        if (!isset($list[0])) {
            throw new UnexpectedValueException($context . ' did not return a record.');
        }

        return $list[0];
    }

    /**
     * @template T of object
     * @param callable(array<string, mixed>): T $factory
     * @return list<T>
     */
    protected function wrapRecordList(mixed $records, callable $factory): array
    {
        $ret = [];
        foreach ($this->recordList($records) as $record) {
            $ret[] = $factory($record);
        }

        return $ret;
    }

    /**
     * @return int|string
     */
    protected function requireResultId(mixed $result, string $context): int|string
    {
        if (is_array($result) && isset($result['id']) && (is_int($result['id']) || is_string($result['id']))) {
            return $result['id'];
        }

        throw new UnexpectedValueException($context . ' did not return an id.');
    }
}
