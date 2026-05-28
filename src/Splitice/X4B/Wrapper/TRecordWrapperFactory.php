<?php

/** @phan-file-suppress PhanUndeclaredMethod */

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

trait TRecordWrapperFactory
{
    public static function fromId(int|string $id, X4BApi $api): static
    {
        /** @phan-suppress-next-line PhanTypeInstantiateTraitStaticOrSelf */
        return new static(['id' => $id], $api);
    }

    /**
     * @param array<string, mixed> $record
     */
    public static function fromRecord(array $record, X4BApi $api): static
    {
        /** @phan-suppress-next-line PhanTypeInstantiateTraitStaticOrSelf */
        return new static($record, $api);
    }
}
