<?php

namespace Splitice\X4B\Wrapper;

class SSLOptions extends AbstractRecordWrapper
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
        $record = $this->api()->module_ssl_options()->get(['id' => $this->getId()]);

        return $record;
    }

    public static function fromPortId(int|string $portId, \Splitice\X4B\X4BApi $api): self
    {
        /** @var array<string, mixed> $record */
        $record = $api->module_ssl_options()->get(['port' => $portId]);

        return new self($record + ['port' => $portId], $api);
    }

    public function getCipher(): ?string
    {
        return $this->getStringField('cipher');
    }

    public function getAutoRegex(): ?string
    {
        return $this->getStringField('auto_regex');
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_ssl_options()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }
}
