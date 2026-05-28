<?php

namespace Splitice\X4B\Client;

/**
 * An interface for a X4B APIv2 compatible client
 */
interface IX4BApiClient
{
    /**
     * Execute an APIv2 request
     *
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function execute(string $module, string $action, array $data = []): mixed;
}
