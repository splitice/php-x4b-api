<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Modules\PortApiModule;
use Splitice\X4B\Wrapper\ACL;
use Splitice\X4B\X4BApi;

final class AuthAndWrapperTest extends TestCase
{
    /**
     * Verify auth callbacks can mutate request data before dispatch.
     */
    public function testAuthReceivesClientAndRequestData(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $auth = $this->createMock(IX4BApiAuthorization::class);
        $selector = ['lease' => 42];
        $payload = ['query' => $selector];

        $auth->expects($this->once())
            ->method('perform')
            ->with(
                $client,
                $this->callback(static fn (array $data): bool => $data === $payload)
            );

        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'all', $payload)
            ->willReturn(['status' => 'ok']);

        $module = new PortApiModule($client, $auth);

        self::assertSame(['status' => 'ok'], $module->all($selector));
    }

    /**
     * Verify API key authentication injects API_KEY into requests.
     */
    public function testAuthKeyInjectsApiKeyIntoRequests(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'all', ['query' => ['lease' => 42], 'API_KEY' => 'api-key-123'])
            ->willReturn(['status' => 'ok']);

        $api = new X4BApi($client);
        $api->auth_key('api-key-123');

        self::assertSame(['status' => 'ok'], $api->module_port()->all(['lease' => 42]));
    }

    /**
     * Verify username/password auth logs in once and reuses the authenticated session.
     */
    public function testAuthLoginOnlyAuthenticatesOnce(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $calls = [];

        $client->expects($this->exactly(3))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data) use (&$calls): array {
                    $calls[] = [$module, $action, $data];

                    if ($module === 'User' && $action === 'login') {
                        return ['status' => 'ok'];
                    }

                    return ['status' => 'ok', 'action' => $action];
                }
            );

        $api = new X4BApi($client);
        $api->auth_login('user@example.test', 'secret');

        self::assertSame(['status' => 'ok', 'action' => 'all'], $api->module_port()->all(['lease' => 42]));
        self::assertSame(['status' => 'ok', 'action' => 'get'], $api->module_port()->get(['id' => 7]));
        self::assertSame(
            [
                ['User', 'login', ['email' => 'user@example.test', 'password' => 'secret']],
                ['Port', 'all', ['query' => ['lease' => 42]]],
                ['Port', 'get', ['query' => ['id' => 7]]],
            ],
            $calls
        );
    }

    /**
     * Verify legacy ACL wrapper helpers still route to the current CRUD actions.
     */
    public function testAclWrapperCrudMethodsReturnUnderlyingResults(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $api = new X4BApi($client);
        $calls = [];

        $client->expects($this->exactly(4))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data) use (&$calls): array {
                    $calls[] = [$module, $action, $data];

                    return ['action' => $action];
                }
            );

        $acl = ACL::fromId(7, $api, 'http');

        self::assertSame(['action' => 'create'], $acl->insert(['comment' => 'created']));
        self::assertSame(['action' => 'get'], $acl->get());
        self::assertSame(['action' => 'update'], $acl->update(['comment' => 'updated']));
        self::assertSame(['action' => 'delete'], $acl->delete());

        self::assertEquals(
            [
                ['ACL', 'create', ['comment' => 'created', 'acl_type' => 'http', 'value' => []]],
                ['ACL', 'get', ['acl_type' => 'http', 'query' => ['id' => 7]]],
                ['ACL', 'update', ['comment' => 'updated', 'acl_type' => 'http', 'query' => ['id' => 7], 'value' => []]],
                ['ACL', 'delete', ['acl_type' => 'http', 'query' => ['id' => 7]]],
            ],
            $calls
        );
    }
}
