<?php

namespace Splitice\X4B\Authorization;

use Splitice\X4B\Client\IX4BApiClient;

interface IX4BApiAuthorization
{
    /**
     * Perform authentication.
     *
     * @param array<string, mixed> $data Data that may be filtered.
     */
    public function perform(IX4BApiClient $api, array &$data): void;
}
