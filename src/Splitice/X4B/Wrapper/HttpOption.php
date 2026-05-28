<?php

namespace Splitice\X4B\Wrapper;

class HttpOption extends AbstractRecordWrapper
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
        $record = $this->api()->module_http_option()->get(['id' => $this->getId()]);

        return $record;
    }

    public static function fromPortId(int|string $portId, \Splitice\X4B\X4BApi $api): self
    {
        /** @var array<string, mixed> $record */
        $record = $api->module_http_option()->get(['port' => $portId]);

        return new self($record + ['port' => $portId], $api);
    }

    public function getKeepalive(): mixed
    {
        return $this->getField('keepalive');
    }

    public function getBackendProtocol(): ?string
    {
        return $this->getStringField('backend_protocol');
    }

    public function getMaintenance(): ?string
    {
        return $this->getStringField('maintenance');
    }

    public function getSSLOptions(): ?SSLOptions
    {
        $sslOption = $this->getArrayField('so');
        if ($sslOption === null || !isset($sslOption['id'])) {
            return null;
        }

        return SSLOptions::fromRecord($sslOption, $this->api());
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_http_option()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }
}
