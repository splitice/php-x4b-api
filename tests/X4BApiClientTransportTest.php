<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Client\X4BApiClient;
use Splitice\X4B\Exceptions\ApiTransportException;

final class X4BApiClientTransportTest extends TestCase
{
    private ?LocalTransportStubServer $server = null;

    /**
     * Stop any started stub server after each test.
     */
    protected function tearDown(): void
    {
        if ($this->server !== null) {
            $this->server->stop();
            $this->server = null;
        }
    }

    /**
     * Ensure execute() posts to the expected module/action URL and decodes the JSON response.
     */
    public function testExecutePostsToExpectedModuleActionUrl(): void
    {
        $client = new X4BApiClient($this->startServer()->getApiBaseUrl());

        $response = $client->execute('Lease', 'all', [
            'lease' => 42,
            'mode' => 'test',
        ]);

        self::assertSame('/apiv2/Lease/all', $response['path']);
        self::assertSame('POST', $response['method']);
        self::assertSame('42', $response['post']['lease']);
        self::assertSame('test', $response['post']['mode']);
        self::assertStringContainsString('multipart/form-data', (string)$response['content_type']);
    }

    /**
     * Ensure the cURL handle retains session cookies across sequential requests.
     */
    public function testExecuteReusesSessionCookiesAcrossRequests(): void
    {
        $client = new X4BApiClient($this->startServer()->getApiBaseUrl());

        $login = $client->execute('User', 'login', [
            'email' => 'user@example.test',
            'password' => 'secret',
        ]);
        $response = $client->execute('Lease', 'all', ['lease' => 42]);

        self::assertSame(1, $login['hit']);
        self::assertSame(2, $response['request_count']);
        self::assertSame('cookie-1', $response['cookies']['x4b_session'] ?? null);
    }

    /**
     * Ensure non-200 HTTP responses raise transport exceptions with the HTTP status code.
     */
    public function testExecuteThrowsOnNon200Response(): void
    {
        $client = new X4BApiClient($this->startServer()->getApiBaseUrl());

        try {
            $client->execute('Test', 'non200');
            self::fail('Expected ApiTransportException was not thrown.');
        } catch (ApiTransportException $exception) {
            self::assertSame(418, $exception->getHttpCode());
            self::assertStringContainsString('418', $exception->getMessage());
        }
    }

    /**
     * Ensure malformed JSON responses are surfaced as transport failures.
     */
    public function testExecuteThrowsOnMalformedJsonResponse(): void
    {
        $client = new X4BApiClient($this->startServer()->getApiBaseUrl());

        try {
            $client->execute('Test', 'bad_json');
            self::fail('Expected ApiTransportException was not thrown.');
        } catch (ApiTransportException $exception) {
            self::assertSame(0, $exception->getHttpCode());
            self::assertStringContainsString('Malformed JSON response from API', $exception->getMessage());
        }
    }

    /**
     * Ensure low-level cURL connection failures are surfaced as transport exceptions.
     */
    public function testExecuteThrowsOnCurlFailure(): void
    {
        $unusedPort = $this->findUnusedPort();
        $client = new X4BApiClient('http://127.0.0.1:' . $unusedPort . '/apiv2');

        try {
            $client->execute('Lease', 'all', ['lease' => 42]);
            self::fail('Expected ApiTransportException was not thrown.');
        } catch (ApiTransportException $exception) {
            self::assertSame(0, $exception->getHttpCode());
            self::assertNotSame('', $exception->getMessage());
        }
    }

    /**
     * Start the local built-in PHP server used by the transport tests.
     */
    private function startServer(): LocalTransportStubServer
    {
        if ($this->server === null) {
            $this->server = new LocalTransportStubServer(__DIR__ . '/support/transport-router.php');
            $this->server->start();
        }

        return $this->server;
    }

    /**
     * Allocate a currently unused local TCP port.
     */
    private function findUnusedPort(): int
    {
        $socket = stream_socket_server('tcp://127.0.0.1:0', $errno, $error);
        if (!is_resource($socket)) {
            self::fail('Unable to allocate an unused TCP port: ' . $error);
        }

        $name = stream_socket_get_name($socket, false);
        fclose($socket);

        if (!is_string($name) || !str_contains($name, ':')) {
            self::fail('Unable to determine the allocated TCP port.');
        }

        return (int)substr($name, strrpos($name, ':') + 1);
    }
}

final class LocalTransportStubServer
{
    private string $routerPath;

    private string $statePath;

    /** @var resource|null */
    private $process = null;

    private ?int $port = null;

    /**
     * @param string $routerPath Router script used by the PHP built-in server.
     */
    public function __construct(string $routerPath)
    {
        $this->routerPath = $routerPath;
        $this->statePath = sys_get_temp_dir() . '/x4b-api-transport-' . uniqid('', true) . '.json';
        file_put_contents($this->statePath, '{"hits":[],"requests":[]}');
    }

    /**
     * Start the local stub server.
     */
    public function start(): void
    {
        if ($this->process !== null) {
            return;
        }

        $this->port = $this->findFreePort();
        $command = sprintf(
            '%s -S 127.0.0.1:%d %s',
            escapeshellarg(PHP_BINARY),
            $this->port,
            escapeshellarg($this->routerPath)
        );

        $descriptors = [
            0 => ['pipe', 'r'],
            1 => ['file', 'php://temp', 'w+'],
            2 => ['file', 'php://temp', 'w+'],
        ];

        $this->process = proc_open(
            $command,
            $descriptors,
            $pipes,
            dirname($this->routerPath),
            ['X4B_API_STUB_STATE_PATH' => $this->statePath] + $_ENV
        );

        if (!is_resource($this->process)) {
            $this->process = null;
            throw new RuntimeException('Unable to start the local transport stub server.');
        }

        $deadline = microtime(true) + 5.0;
        while (microtime(true) < $deadline) {
            $connection = @fsockopen('127.0.0.1', $this->port);
            if (is_resource($connection)) {
                fclose($connection);
                return;
            }

            usleep(100000);
        }

        $this->stop();
        throw new RuntimeException('Timed out waiting for the local transport stub server.');
    }

    /**
     * Stop the local stub server and remove its temporary state file.
     */
    public function stop(): void
    {
        if (is_resource($this->process)) {
            proc_terminate($this->process);
            proc_close($this->process);
        }

        $this->process = null;
        $this->port = null;

        if (is_file($this->statePath)) {
            unlink($this->statePath);
        }
    }

    /**
     * Return the API base URL exposed by the stub server.
     */
    public function getApiBaseUrl(): string
    {
        if ($this->port === null) {
            throw new RuntimeException('The local transport stub server has not been started.');
        }

        return 'http://127.0.0.1:' . $this->port . '/apiv2';
    }

    /**
     * Find an unused localhost TCP port.
     */
    private function findFreePort(): int
    {
        $socket = stream_socket_server('tcp://127.0.0.1:0', $errno, $error);
        if (!is_resource($socket)) {
            throw new RuntimeException('Unable to allocate a local TCP port: ' . $error);
        }

        $name = stream_socket_get_name($socket, false);
        fclose($socket);

        if (!is_string($name) || !str_contains($name, ':')) {
            throw new RuntimeException('Unable to determine the allocated TCP port.');
        }

        return (int)substr($name, strrpos($name, ':') + 1);
    }
}
