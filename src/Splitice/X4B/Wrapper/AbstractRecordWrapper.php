<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;
use UnexpectedValueException;

/** @phpstan-consistent-constructor */
abstract class AbstractRecordWrapper extends AbstractWrapper
{
    private int|string $id;

    /**
     * @var array<string, mixed>|null
     */
    private ?array $data;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields, X4BApi $api)
    {
        parent::__construct($api);
        $this->id = self::requireId($fields);
        $this->data = self::extractRecord($fields);
    }

    /**
     * @return int|string
     */
    public function getId(): int|string
    {
        return $this->id;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData(): array
    {
        if ($this->data === null) {
            $this->data = $this->loadData();
        }

        return $this->data;
    }

    /**
     * @return array<string, mixed>
     */
    public function refresh(): array
    {
        $this->data = $this->loadData();

        return $this->data;
    }

    protected function invalidate(): void
    {
        $this->data = null;
    }

    /**
     * @return array<string, mixed>
     */
    abstract protected function loadData(): array;

    protected function getField(string $field, mixed $default = null): mixed
    {
        $data = $this->getData();
        if (!array_key_exists($field, $data)) {
            return $default;
        }

        return $data[$field];
    }

    /**
     * @return array<string, mixed>|null
     */
    protected function getArrayField(string $field): ?array
    {
        $value = $this->getField($field);

        return self::normalizeRecord($value);
    }

    protected function getStringField(string $field): ?string
    {
        $value = $this->getField($field);
        if (!is_scalar($value)) {
            return null;
        }

        return (string) $value;
    }

    /**
     * @return int|string|null
     */
    protected function getIdentifierField(string $field): int|string|null
    {
        $value = $this->getField($field);
        if (is_int($value) || is_string($value)) {
            return $value;
        }

        return null;
    }

    protected function getBooleanField(string $field): ?bool
    {
        $value = $this->getField($field);
        if (is_bool($value)) {
            return $value;
        }
        if ($value === 'yes') {
            return true;
        }
        if ($value === 'no') {
            return false;
        }

        return null;
    }

    /**
     * @param array<string, mixed> $fields
     * @return array<string, mixed>|null
     */
    private static function extractRecord(array $fields): ?array
    {
        if (isset($fields['record'])) {
            return self::normalizeRecord($fields['record']);
        }

        if (self::extractId($fields) === null) {
            return null;
        }

        $keys = array_keys($fields);
        sort($keys);

        return $keys === ['id'] || $keys === ['id', 'lease'] || $keys === ['id', 'port'] ? null : $fields;
    }

    /**
     * @param array<string, mixed> $fields
     * @return int|string
     */
    private static function requireId(array $fields): int|string
    {
        $id = self::extractId($fields);
        if ($id === null) {
            throw new UnexpectedValueException('Wrapper fields must contain an id.');
        }

        return $id;
    }

    /**
     * @param array<string, mixed> $fields
     * @return int|string|null
     */
    private static function extractId(array $fields): int|string|null
    {
        $id = $fields['id'] ?? null;
        if (is_int($id) || is_string($id)) {
            return $id;
        }

        return null;
    }
}
