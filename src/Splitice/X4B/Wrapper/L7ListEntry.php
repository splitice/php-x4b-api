<?php

namespace Splitice\X4B\Wrapper;

class L7ListEntry extends AbstractRecordWrapper
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
        $record = $this->api()->module_l7_list()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getAddress(): ?string
    {
        return $this->getStringField('addr');
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function getRequestId(): ?string
    {
        return $this->getStringField('request_id');
    }

    public function getPort(): ?Port
    {
        $portId = $this->getIdentifierField('port');
        if ($portId === null) {
            return null;
        }

        return Port::fromId($portId, $this->api());
    }

    public function getServerId(): int|string|null
    {
        return $this->getIdentifierField('server');
    }

    public function delete(): mixed
    {
        $value = [
            'list_type' => $this->getType(),
            'client_ip' => $this->getAddress(),
        ];

        $portId = $this->getIdentifierField('port');
        if ($portId !== null) {
            $value['port_id'] = $portId;
        }

        $serverId = $this->getServerId();
        if ($serverId !== null) {
            $value['servers'] = [$serverId];
        }

        $result = $this->api()->module_l7_list()->remove($value);
        $this->invalidate();

        return $result;
    }
}
