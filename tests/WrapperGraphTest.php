<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Wrapper\Account;
use Splitice\X4B\Wrapper\DnsZone;
use Splitice\X4B\Wrapper\L7ListEntry;
use Splitice\X4B\Wrapper\Port;
use Splitice\X4B\Wrapper\Service;
use Splitice\X4B\Wrapper\SSLUser;
use Splitice\X4B\X4BApi;

final class WrapperGraphTest extends TestCase
{
    public function testAccountCollectionsReturnTypedWrappers(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $calls = [];

        $client->expects($this->exactly(3))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data) use (&$calls): array {
                    $calls[] = [$module, $action, $data];

                    return match ($module) {
                        'Service' => [['id' => 11, 'type' => 'lease']],
                        'DnsZone' => [['id' => 21, 'domain' => 'zone.example.test']],
                        'SSLUser' => [['id' => 31, 'domain' => 'ssl.example.test', 'status' => 'generated']],
                        default => [],
                    };
                }
            );

        $account = Account::fromApi(new X4BApi($client));

        $services = $account->getServices();
        $zones = $account->getDnsZones();
        $sslUsers = $account->getSSLUsers();

        self::assertCount(1, $services);
        self::assertCount(1, $zones);
        self::assertCount(1, $sslUsers);
        self::assertInstanceOf(Service::class, $services[0]);
        self::assertInstanceOf(DnsZone::class, $zones[0]);
        self::assertInstanceOf(SSLUser::class, $sslUsers[0]);
        self::assertSame(
            [
                ['Service', 'all', ['query' => []]],
                ['DnsZone', 'all', ['query' => []]],
                ['SSLUser', 'all', ['query' => []]],
            ],
            $calls
        );
    }

    public function testServiceAndLeaseNavigationUsesEmbeddedLeaseData(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $calls = [];

        $client->expects($this->exactly(2))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data) use (&$calls): array {
                    $calls[] = [$module, $action, $data];

                    if ($module === 'Service') {
                        return [[
                            'id' => 11,
                            'type' => 'lease',
                            'lease' => [
                                'id' => 21,
                                'type' => 'lease',
                                'status' => 'active',
                                'current_usage' => 42,
                                'service' => 11,
                                'plan' => ['id' => 31, 'name' => 'Pro'],
                            ],
                        ]];
                    }

                    if ($module === 'Port') {
                        return [[
                            'id' => 41,
                            'lease' => 21,
                            'protocol' => 'http',
                            'type' => 'single',
                        ]];
                    }

                    return [];
                }
            );

        $api = new X4BApi($client);
        $service = Service::fromId(11, $api);
        $lease = $service->getLease();

        self::assertNotNull($lease);
        self::assertSame(21, $lease->getId());
        self::assertSame('Pro', $lease->getPlan()?->getName());

        $ports = $lease->getPorts();
        self::assertCount(1, $ports);
        self::assertInstanceOf(Port::class, $ports[0]);
        self::assertSame(
            [
                ['Service', 'all', ['query' => ['id' => 11]]],
                ['Port', 'all', ['query' => ['lease' => 21]]],
            ],
            $calls
        );
    }

    public function testPortChildrenCarryPortContextForReadsAndMutations(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $calls = [];

        $client->expects($this->exactly(9))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data) use (&$calls): mixed {
                    $calls[] = [$module, $action, $data];

                    return match ([$module, $action]) {
                        ['Port', 'get'] => [
                            'id' => 41,
                            'lease' => 21,
                            'protocol' => 'https',
                            'fw' => 51,
                            'ssl_option' => 61,
                        ],
                        ['PortBackend', 'all'] => [[
                            'id' => 81,
                            'port' => 41,
                            'to' => ['addr' => '1.2.3.4', 'port' => 443],
                        ]],
                        ['PortBackend', 'delete'] => ['status' => 'ok'],
                        ['Zone', 'all'] => [[
                            'id' => 91,
                            'port' => 41,
                            'expr' => '/api/*',
                            'mode' => 'safe',
                            'order' => 1,
                        ]],
                        ['Zone', 'move_up'] => ['status' => 'ok'],
                        ['ACL', 'all'] => [[
                            'id' => 121,
                            'mask' => '10.0.0.0/24',
                            'type' => 'allow',
                            'order' => 1,
                            'fw' => 51,
                        ]],
                        ['ACL', 'update'] => ['status' => 'ok'],
                        ['L7List', 'all'] => [[
                            'id' => 131,
                            'port' => 41,
                            'addr' => '5.6.7.8',
                            'type' => 'whitelist',
                            'server' => 141,
                        ]],
                        ['L7List', 'remove'] => ['status' => 'ok'],
                        default => throw new RuntimeException('Unexpected call ' . $module . '/' . $action),
                    };
                }
            );

        $api = new X4BApi($client);
        $port = Port::fromId(41, $api);

        self::assertTrue($port->isHttps());

        $backend = $port->getBackends()[0];
        $zone = $port->getZones()[0];
        $acl = $port->getHttpAcls()[0];
        $entry = $port->getWhitelist()->getEntries()[0];

        self::assertInstanceOf(L7ListEntry::class, $entry);
        self::assertSame('1.2.3.4', $backend->getBackendAddress());
        self::assertSame('/api/*', $zone->getExpr());
        self::assertSame('10.0.0.0/24', $acl->getMask());
        self::assertSame('5.6.7.8', $entry->getAddress());

        $backend->delete();
        $zone->moveUp();
        $acl->updateFields(['mask' => '10.0.1.0/24']);
        $entry->delete();

        self::assertSame(
            [
                ['Port', 'get', ['query' => ['id' => 41]]],
                ['PortBackend', 'all', ['query' => ['port' => 41]]],
                ['Zone', 'all', ['query' => ['port' => 41]]],
                ['ACL', 'all', ['query' => ['port' => 41], 'acl_type' => 'http']],
                ['L7List', 'all', ['query' => ['port' => 41, 'type' => 'whitelist']]],
                ['PortBackend', 'delete', ['query' => ['id' => 81, 'port' => 41]]],
                ['Zone', 'move_up', ['query' => ['id' => 91, 'port' => 41]]],
                ['ACL', 'update', ['query' => ['id' => 121, 'port' => 41], 'value' => ['mask' => '10.0.1.0/24'], 'acl_type' => 'http']],
                ['L7List', 'remove', ['value' => ['list_type' => 'whitelist', 'client_ip' => '5.6.7.8', 'port_id' => 41, 'servers' => [141]]]],
            ],
            $calls
        );
    }

    public function testParentHelpersAndSslUserPrimaryDispatchExpectedPayloads(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $calls = [];

        $client->expects($this->exactly(6))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data) use (&$calls): array {
                    $calls[] = [$module, $action, $data];

                    return ['status' => 'ok'];
                }
            );

        $api = new X4BApi($client);
        $account = Account::fromApi($api);
        $lease = \Splitice\X4B\Wrapper\Lease::fromRecord(['id' => 21, 'service' => 11], $api);
        $port = Port::fromRecord(['id' => 41, 'protocol' => 'https'], $api);
        $zone = DnsZone::fromId(51, $api);
        $sslUser = SSLUser::fromId(61, $api);

        $account->createDnsZone(['domain' => 'created.example.test']);
        $account->createSSLUser(['domain' => 'ssl.example.test']);
        $lease->createPort(['protocol' => 'http']);
        $port->createBackend(['to' => ['addr' => '1.2.3.4', 'port' => 80]]);
        $zone->createRecord(['type' => 'A', 'name' => '@', 'value' => '1.2.3.4']);
        $sslUser->setPrimary();

        self::assertSame(
            [
                ['DnsZone', 'create', ['value' => ['domain' => 'created.example.test']]],
                ['SSLUser', 'create', ['value' => ['domain' => 'ssl.example.test']]],
                ['Port', 'create', ['value' => ['lease' => 21, 'protocol' => 'http']]],
                ['PortBackend', 'create', ['value' => ['port' => 41, 'to' => ['addr' => '1.2.3.4', 'port' => 80]]]],
                ['DnsRecord', 'create', ['value' => ['dz' => 51, 'type' => 'A', 'name' => '@', 'value' => '1.2.3.4']]],
                ['SSLUser', 'setPrimary', ['query' => ['id' => 61]]],
            ],
            $calls
        );
    }
}
