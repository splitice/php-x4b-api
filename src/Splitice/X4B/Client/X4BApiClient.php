<?php

namespace Splitice\X4B\Client;

use Splitice\X4B\Exceptions\ApiTransportException;

/**
 * X4B APIv2 client posting form data and decoding JSON responses.
 */
class X4BApiClient implements IX4BApiClient
{
    public const URL = 'https://www.x4b.net/apiv2/';

    private \CurlHandle $ch;

    /** @var non-empty-string */
    private string $url;

    /**
     * @param non-empty-string $url
     * @param string|null $apiKeyAuthorizationScheme Bearer or Bearer api selects a header; null keeps POST data.
     */
    public function __construct(string $url = self::URL, private readonly ?string $apiKeyAuthorizationScheme = null)
    {
        if (!in_array($apiKeyAuthorizationScheme, [null, 'Bearer', 'Bearer api'], true)) {
            throw new \InvalidArgumentException('API key authorization scheme must be Bearer, Bearer api, or null.');
        }
        $this->url = $url;
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($this->ch, CURLOPT_HEADER, false);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, '');
        curl_setopt($this->ch, CURLOPT_USERAGENT, 'x4b-api-client');
    }

    /**
     * @return non-empty-string
     */
    private function build_url(string $module, string $method): string
    {
        return rtrim($this->url, '/') . '/' . $module . '/' . $method;
    }

    /**
     * @param array<string, mixed> $data
     * @return mixed
     */
    public function execute(string $module, string $action, array $data = []): mixed
    {
        $headers = [];
        if ($this->apiKeyAuthorizationScheme !== null && array_key_exists('API_KEY', $data)) {
            $key = $data['API_KEY'];
            if (!is_string($key) || strpbrk($key, "\r\n") !== false) {
                throw new \InvalidArgumentException('An API key must be a string without line breaks.');
            }
            $headers[] = 'Authorization: ' . $this->apiKeyAuthorizationScheme . ' ' . $key;
            unset($data['API_KEY']);
        }
        // Reset this on every call so a reused handle never forwards an earlier key.
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->ch, CURLOPT_URL, $this->build_url($module, $action));

        $response = curl_exec($this->ch);
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        if ($response === false) {
            throw new ApiTransportException(0, curl_error($this->ch));
        }

        if ($code !== 200) {
            throw new ApiTransportException($code);
        }

        if (!is_string($response)) {
            throw new ApiTransportException(0, 'Unexpected non-string response from cURL.');
        }

        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ApiTransportException(0, 'Malformed JSON response from API: ' . json_last_error_msg());
        }

        return $decoded;
    }
}
