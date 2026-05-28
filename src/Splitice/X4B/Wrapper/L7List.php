<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;
use UnexpectedValueException;

class L7List extends AbstractWrapper
{
    private int|string $portId;

    private string $type;

    public function __construct(X4BApi $api, int|string $portId, string $type)
    {
        parent::__construct($api);
        if (!in_array($type, ['whitelist', 'blacklist'], true)) {
            throw new UnexpectedValueException('L7 list type must be whitelist or blacklist.');
        }

        $this->portId = $portId;
        $this->type = $type;
    }

    public static function whitelist(int|string $portId, X4BApi $api): self
    {
        return new self($api, $portId, 'whitelist');
    }

    public static function blacklist(int|string $portId, X4BApi $api): self
    {
        return new self($api, $portId, 'blacklist');
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPort(): Port
    {
        return Port::fromId($this->portId, $this->api());
    }

    /**
     * @return list<L7ListEntry>
     */
    public function getEntries(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_l7_list()->all(['port' => $this->portId, 'type' => $this->type]),
            fn (array $record): L7ListEntry => L7ListEntry::fromRecord($record, $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function add(array $value): mixed
    {
        return $this->api()->module_l7_list()->add(
            ['list_type' => $this->type, 'port_id' => $this->portId] + $value
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function remove(array $value): mixed
    {
        return $this->api()->module_l7_list()->remove(
            ['list_type' => $this->type, 'port_id' => $this->portId] + $value
        );
    }
}
