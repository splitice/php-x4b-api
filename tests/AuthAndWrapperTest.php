<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Modules\PortApiModule;
use Splitice\X4B\Wrapper\ACL;
use Splitice\X4B\X4BApi;

final class AuthAndWrapperTest extends TestCase
{
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

        self::assertSame(['action' => 'insert'], $acl->insert(['comment' => 'created']));
        self::assertSame(['action' => 'get'], $acl->get());
        self::assertSame(['action' => 'update'], $acl->update(['comment' => 'updated']));
        self::assertSame(['action' => 'delete'], $acl->delete());

        self::assertEquals(
            [
                ['ACL', 'insert', ['comment' => 'created', 'acl_type' => 'http', 'value' => []]],
                ['ACL', 'get', ['acl_type' => 'http', 'query' => ['id' => 7]]],
                ['ACL', 'update', ['comment' => 'updated', 'acl_type' => 'http', 'query' => ['id' => 7], 'value' => []]],
                ['ACL', 'delete', ['acl_type' => 'http', 'query' => ['id' => 7]]],
            ],
            $calls
        );
    }
}
