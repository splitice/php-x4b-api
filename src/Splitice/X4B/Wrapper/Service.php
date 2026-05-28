<?php

namespace Splitice\X4B\Wrapper;

class Service extends AbstractRecordWrapper
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
        return $this->firstRecord($this->api()->module_service()->all(['id' => $this->getId()]), 'Service');
    }

    public function getVanity(): ?string
    {
        return $this->getStringField('vanity');
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function getGbLimit(): mixed
    {
        return $this->getField('gb_limit');
    }

    public function getLease(): ?Lease
    {
        $lease = $this->getArrayField('lease');
        if ($lease !== null) {
            return Lease::fromRecord($lease, $this->api());
        }

        $records = $this->recordList($this->api()->module_lease()->all(['service' => $this->getId()]));
        if (!isset($records[0])) {
            return null;
        }

        return Lease::fromRecord($records[0], $this->api());
    }

    /**
     * @return list<Port>
     */
    public function getPorts(): array
    {
        $lease = $this->getLease();

        return $lease?->getPorts() ?? [];
    }

    /**
     * @return list<Tunnel>
     */
    public function getTunnels(): array
    {
        $lease = $this->getLease();

        return $lease?->getTunnels() ?? [];
    }
}
