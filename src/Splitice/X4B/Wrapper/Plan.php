<?php

namespace Splitice\X4B\Wrapper;

class Plan extends AbstractRecordWrapper
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
        $record = $this->api()->module_plan()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getName(): ?string
    {
        return $this->getStringField('name');
    }
}
