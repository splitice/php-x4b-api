<?php

namespace Splitice\X4B\Wrapper;

class Layer7Rule extends AbstractRecordWrapper
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
        $record = $this->api()->module_layer7_rule()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getMatch(): ?string
    {
        return $this->getStringField('match');
    }

    public function getOrder(): mixed
    {
        return $this->getField('order');
    }

    public function isEnabled(): ?bool
    {
        return $this->getBooleanField('enabled');
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_layer7_rule()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_layer7_rule()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function moveUp(): mixed
    {
        $order = $this->getOrder();
        $next = is_numeric($order) ? ((int) $order) - 1 : -1;

        return $this->update(['order' => $next]);
    }

    public function moveDown(): mixed
    {
        $order = $this->getOrder();
        $next = is_numeric($order) ? ((int) $order) + 1 : 1;

        return $this->update(['order' => $next]);
    }
}
