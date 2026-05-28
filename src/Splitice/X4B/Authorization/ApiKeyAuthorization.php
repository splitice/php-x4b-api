<?php

namespace Splitice\X4B\Authorization;

use Splitice\X4B\Client\IX4BApiClient;

class ApiKeyAuthorization implements IX4BApiAuthorization
{
    private string $api_key;

    /**
     * @param string $apiKey API key value to inject into requests.
     */
    public function __construct(string $apiKey)
    {
        $this->api_key = $apiKey;
    }

    /**
     * Inject the API key into the request payload.
     *
     * @param IX4BApiClient $api API transport client.
     * @param array<string, mixed> $data Mutable request payload.
     */
    public function perform(IX4BApiClient $api, array &$data): void
    {
        $data['API_KEY'] = $this->api_key;
    }
}
