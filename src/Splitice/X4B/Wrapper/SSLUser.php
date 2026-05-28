<?php

namespace Splitice\X4B\Wrapper;

class SSLUser extends AbstractRecordWrapper
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
        $record = $this->api()->module_ssl_user()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getDomain(): ?string
    {
        return $this->getStringField('domain');
    }

    public function getStatus(): ?string
    {
        return $this->getStringField('status');
    }

    public function getGroup(): mixed
    {
        return $this->getField('group');
    }

    public function isPrimary(): ?bool
    {
        return $this->getBooleanField('primary');
    }

    public function isReady(): ?bool
    {
        return $this->getBooleanField('ready');
    }

    public function getNeeds(): ?string
    {
        return $this->getStringField('needs');
    }

    public function getChallengeType(): ?string
    {
        return $this->getStringField('challengeType');
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_ssl_user()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function enable(): mixed
    {
        $result = $this->api()->module_ssl_user()->enable(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function disable(): mixed
    {
        $result = $this->api()->module_ssl_user()->disable(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function renew(): mixed
    {
        $result = $this->api()->module_ssl_user()->renew(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function groupWith(SSLUser|int|string $target): mixed
    {
        $targetId = $target instanceof self ? $target->getId() : $target;
        $result = $this->api()->module_ssl_user()->group(['id' => $this->getId()], ['target' => $targetId]);
        $this->invalidate();

        return $result;
    }

    public function ungroup(): mixed
    {
        $result = $this->api()->module_ssl_user()->ungroup(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function setPrimary(): mixed
    {
        $result = $this->api()->module_ssl_user()->setPrimary(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }
}
