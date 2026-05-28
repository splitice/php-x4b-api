<?php

namespace Splitice\X4B\Wrapper;

class LeaseIP extends AbstractRecordWrapper
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
        $record = $this->api()->module_lease_ip()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getIp(): ?string
    {
        return $this->getStringField('ip');
    }

    public function isRouted(): ?bool
    {
        return $this->getBooleanField('routed');
    }

    public function getLease(): ?Lease
    {
        $leaseId = $this->getIdentifierField('lease');
        if ($leaseId === null) {
            return null;
        }

        return Lease::fromId($leaseId, $this->api());
    }

    /**
     * @return list<Layer4Rule>
     */
    public function getLayer4Rules(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_layer4_rule()->all(['lip' => $this->getId()]),
            fn (array $record): Layer4Rule => Layer4Rule::fromRecord($record, $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createLayer4Rule(array $value): mixed
    {
        return $this->api()->module_layer4_rule()->create(['lip' => $this->getId()] + $value);
    }
}
