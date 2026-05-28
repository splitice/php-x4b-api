<?php

namespace Splitice\X4B\Wrapper;

class DnsZone extends AbstractRecordWrapper
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
        $record = $this->api()->module_dns_zone()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getDomain(): ?string
    {
        return $this->getStringField('domain');
    }

    /**
     * @return list<DnsRecord>
     */
    public function getRecords(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_dns_record()->all(['dz' => $this->getId()]),
            fn (array $record): DnsRecord => DnsRecord::fromRecord($record, $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createRecord(array $value): mixed
    {
        return $this->api()->module_dns_record()->create(['dz' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_dns_zone()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_dns_zone()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }
}
