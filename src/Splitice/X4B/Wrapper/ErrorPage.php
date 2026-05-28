<?php

namespace Splitice\X4B\Wrapper;

class ErrorPage extends AbstractRecordWrapper
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
        $record = $this->api()->module_error_page()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getCode(): mixed
    {
        return $this->getField('code');
    }

    public function getHtml(): ?string
    {
        return $this->getStringField('html');
    }

    public function getRedirect(): ?string
    {
        return $this->getStringField('redirect');
    }

    public function getRedirectCode(): mixed
    {
        return $this->getField('redirect_code');
    }

    /**
     * @param array<string, mixed> $value
     */
    public function update(array $value): mixed
    {
        $result = $this->api()->module_error_page()->update(['id' => $this->getId()], $value);
        $this->invalidate();

        return $result;
    }

    public function delete(): mixed
    {
        $result = $this->api()->module_error_page()->delete(['id' => $this->getId()]);
        $this->invalidate();

        return $result;
    }
}
