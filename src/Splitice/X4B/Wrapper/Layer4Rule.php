<?php

namespace Splitice\X4B\Wrapper;

class Layer4Rule extends AbstractRecordWrapper
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
        $record = $this->api()->module_layer4_rule()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getName(): ?string
    {
        return $this->getStringField('name');
    }

    public function getHookName(): ?string
    {
        return $this->getStringField('hook_name');
    }

    public function getFilterResult(): ?string
    {
        return $this->getStringField('filter_result');
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
        $result = $this->api()->module_layer4_rule()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_layer4_rule()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function moveUp(): mixed
    {
        $result = $this->api()->module_layer4_rule()->move_up(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }

    public function moveDown(): mixed
    {
        $result = $this->api()->module_layer4_rule()->move_down(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }
}
