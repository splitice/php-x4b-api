<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class Tunnel extends AbstractRecordWrapper
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
        $record = $this->api()->module_tunnel()->get(['id' => $this->getId()]);

        return $record;
    }

    public static function latestVersions(X4BApi $api): mixed
    {
        return $api->module_tunnel()->latest_versions();
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function getInternal(): ?string
    {
        return $this->getStringField('internal');
    }

    public function getBackend(): mixed
    {
        return $this->getField('backend');
    }

    /**
     * @return list<Region>
     */
    public function getRegions(): array
    {
        $regions = $this->getField('regions');
        if (!is_array($regions)) {
            return [];
        }

        $ret = [];
        foreach ($regions as $regionId) {
            if (is_int($regionId) || is_string($regionId)) {
                $ret[] = Region::fromId($regionId, $this->api());
            }
        }

        return $ret;
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
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_tunnel()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_tunnel()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function upgrade(): mixed
    {
        $result = $this->api()->module_tunnel()->upgrade(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function script(array $data = []): mixed
    {
        return $this->api()->module_tunnel()->script(['tunnels' => (string) $this->getId()] + $data);
    }
}
