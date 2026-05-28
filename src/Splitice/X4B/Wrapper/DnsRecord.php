<?php

namespace Splitice\X4B\Wrapper;

class DnsRecord extends AbstractRecordWrapper
{
    use TRecordWrapperFactory;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields, \Splitice\X4B\X4BApi $api)
    {
        parent::__construct($fields, $api);
    }

    /**
     * @return array<string, mixed>
     */
    protected function loadData(): array
    {
        /** @var array<string, mixed> $record */
        $record = $this->api()->module_dns_record()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function getName(): ?string
    {
        return $this->getStringField('name');
    }

    public function getValue(): ?string
    {
        return $this->getStringField('value');
    }

    public function getZone(): ?DnsZone
    {
        $zoneId = $this->getIdentifierField('dz');
        if ($zoneId === null) {
            return null;
        }

        return DnsZone::fromId($zoneId, $this->api());
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_dns_record()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_dns_record()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }
}
