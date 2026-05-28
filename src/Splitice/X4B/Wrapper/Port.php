<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class Port
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

    public function getAclType(): string
    {
        return 'http';
    }

    /**
     * @return list<ACL>
     */
    public function getACLs(): array
    {
        $target = $this->getAclType();
        $records = $this->api->module_acl($target)->all(['port' => $this->id]);
        $acls = [];

        if (!is_array($records)) {
            return $acls;
        }

        foreach ($records as $record) {
            if (is_array($record) && isset($record['id']) && (is_int($record['id']) || is_string($record['id']))) {
                $acls[] = ACL::fromId($record['id'], $this->api, $target);
            }
        }

        return $acls;
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
