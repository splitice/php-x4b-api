# php-x4b-api

PHP client library for the X4B.NET API v2.

## API keys

The default client sends keys as a POSTed `API_KEY` field:

```php
$api = new \Splitice\X4B\X4BApi();
$api->auth_key($key);
```

To send `Authorization: Bearer <API_KEY>`, configure the HTTP transport:

```php
$transport = new \Splitice\X4B\Client\X4BApiClient(apiKeyAuthorizationScheme: 'Bearer');
$api = new \Splitice\X4B\X4BApi($transport);
$api->auth_key($key);
```

Use `'Bearer api'` for the legacy `Authorization: Bearer api <API_KEY>` format.
Header mode removes `API_KEY` from POST data. Each request replaces its header,
so reusing a transport for an anonymous client does not reuse an earlier key.
Invalid and revoked keys receive HTTP 403 from the application.

## Development

- PHP 8.2 or newer
- `composer install`
- `composer ci`
