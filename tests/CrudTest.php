<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\X4BApi;

final class CrudTest extends TestCase
{
    /**
     * Verify every explicit module accessor dispatches the exact Swagger method name.
     */
    public function testDispatchesExactSwaggerSurface(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->exactly($this->countExpectedCalls()))
            ->method('execute')
            ->willReturnCallback(
                static function (string $module, string $action, array $data): array {
                    return [
                        'module' => $module,
                        'action' => $action,
                        'data' => $data,
                    ];
                }
            );

        $api = new X4BApi($client);
        $expectedCalls = [];

        foreach ($this->moduleMatrix() as $moduleSpec) {
            $module = $api->{$moduleSpec['accessor']}(...$moduleSpec['accessor_args']);
            self::assertInstanceOf($moduleSpec['class'], $module);

            foreach ($moduleSpec['methods'] as $methodSpec) {
                $result = $module->{$methodSpec['name']}(...$methodSpec['args']);
                self::assertSame($moduleSpec['module'], $result['module']);
                self::assertSame($methodSpec['name'], $result['action']);
                self::assertSame($methodSpec['expected_data'], $result['data']);

                $expectedCalls[] = [
                    $moduleSpec['module'],
                    $methodSpec['name'],
                    $methodSpec['expected_data'],
                ];
            }
        }

        self::assertNotEmpty($expectedCalls);
    }

    /**
     * Count the total number of expected transport calls.
     */
    private function countExpectedCalls(): int
    {
        $count = 0;
        foreach ($this->moduleMatrix() as $moduleSpec) {
            $count += count($moduleSpec['methods']);
        }

        return $count;
    }

    /**
     * Build the explicit Swagger module surface matrix.
     *
     * @return array<int, array{
     *     accessor: string,
     *     accessor_args: list<mixed>,
     *     class: class-string,
     *     module: string,
     *     methods: list<array{name: string, args: list<mixed>, expected_data: array<string, mixed>}>
     * }>
     */
    private function moduleMatrix(): array
    {
        $bulkRows = [
            'new' => ['value' => ['example' => 'value']],
            '7' => ['query' => ['id' => 7], 'value' => ['example' => 'updated']],
        ];

        return [
            [
                'accessor' => 'module_dns_record',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\DnsRecordApiModule::class,
                'module' => 'DnsRecord',
                'methods' => $this->crudMethods($bulkRows),
            ],
            [
                'accessor' => 'module_dns_zone',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\DnsZoneApiModule::class,
                'module' => 'DnsZone',
                'methods' => $this->crudMethods($bulkRows),
            ],
            [
                'accessor' => 'module_error_page',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\ErrorPageApiModule::class,
                'module' => 'ErrorPage',
                'methods' => $this->crudMethods($bulkRows),
            ],
            [
                'accessor' => 'module_firewall_profile',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\FirewallProfileApiModule::class,
                'module' => 'FirewallProfile',
                'methods' => array_merge($this->queryMethods(), [
                    ['name' => 'update', 'args' => [['id' => 7], ['enabled' => 'yes']], 'expected_data' => ['query' => ['id' => 7], 'value' => ['enabled' => 'yes']]],
                    ['name' => 'bulk', 'args' => [$bulkRows], 'expected_data' => ['rows' => $bulkRows]],
                ]),
            ],
            [
                'accessor' => 'module_http_option',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\HttpOptionApiModule::class,
                'module' => 'HttpOption',
                'methods' => array_merge($this->queryMethods(), [
                    ['name' => 'update', 'args' => [['id' => 7], ['enabled' => 'yes']], 'expected_data' => ['query' => ['id' => 7], 'value' => ['enabled' => 'yes']]],
                    ['name' => 'bulk', 'args' => [$bulkRows], 'expected_data' => ['rows' => $bulkRows]],
                ]),
            ],
            [
                'accessor' => 'module_l7_list',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\L7ListApiModule::class,
                'module' => 'L7List',
                'methods' => [
                    ['name' => 'all', 'args' => [['port' => 1]], 'expected_data' => ['query' => ['port' => 1]]],
                    ['name' => 'get', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'describe', 'args' => [], 'expected_data' => []],
                    ['name' => 'create', 'args' => [['list_type' => 'blacklist', 'port_id' => 1, 'client_ip' => '127.0.0.1']], 'expected_data' => ['value' => ['list_type' => 'blacklist', 'port_id' => 1, 'client_ip' => '127.0.0.1']]],
                    ['name' => 'delete', 'args' => [['list_type' => 'blacklist', 'port_id' => 1, 'client_ip' => '127.0.0.1']], 'expected_data' => ['value' => ['list_type' => 'blacklist', 'port_id' => 1, 'client_ip' => '127.0.0.1']]],
                    ['name' => 'add', 'args' => [['list_type' => 'whitelist', 'port_id' => 1, 'client_ip' => '127.0.0.2']], 'expected_data' => ['value' => ['list_type' => 'whitelist', 'port_id' => 1, 'client_ip' => '127.0.0.2']]],
                    ['name' => 'remove', 'args' => [['list_type' => 'whitelist', 'port_id' => 1, 'client_ip' => '127.0.0.2']], 'expected_data' => ['value' => ['list_type' => 'whitelist', 'port_id' => 1, 'client_ip' => '127.0.0.2']]],
                ],
            ],
            [
                'accessor' => 'module_layer4_rule',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\Layer4RuleApiModule::class,
                'module' => 'Layer4Rule',
                'methods' => array_merge($this->crudMethods($bulkRows), [
                    ['name' => 'move_up', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'move_down', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                ]),
            ],
            [
                'accessor' => 'module_layer7_rule',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\Layer7RuleApiModule::class,
                'module' => 'Layer7Rule',
                'methods' => array_merge($this->crudMethods($bulkRows), [
                    ['name' => 'create_drop', 'args' => [['port' => 1, 'match' => '/foo/']], 'expected_data' => ['value' => ['port' => 1, 'match' => '/foo/']]],
                    ['name' => 'create_rate_blacklist', 'args' => [['port' => 1, 'match' => '/foo/', 'interval' => 60, 'global' => 10, 'client' => 5]], 'expected_data' => ['value' => ['port' => 1, 'match' => '/foo/', 'interval' => 60, 'global' => 10, 'client' => 5]]],
                    ['name' => 'create_rate_whitelist', 'args' => [['port' => 1, 'match' => '/foo/', 'interval' => 60, 'global' => 10, 'client' => 5]], 'expected_data' => ['value' => ['port' => 1, 'match' => '/foo/', 'interval' => 60, 'global' => 10, 'client' => 5]]],
                ]),
            ],
            [
                'accessor' => 'module_lease',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\LeaseApiModule::class,
                'module' => 'Lease',
                'methods' => [
                    ['name' => 'all', 'args' => [['user' => 1]], 'expected_data' => ['query' => ['user' => 1]]],
                ],
            ],
            [
                'accessor' => 'module_lease_ip',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\LeaseIPApiModule::class,
                'module' => 'LeaseIP',
                'methods' => [
                    ['name' => 'all', 'args' => [['lease' => 1]], 'expected_data' => ['query' => ['lease' => 1]]],
                    ['name' => 'get', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                ],
            ],
            [
                'accessor' => 'module_plan',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\PlanApiModule::class,
                'module' => 'Plan',
                'methods' => $this->queryMethods(),
            ],
            [
                'accessor' => 'module_port',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\PortApiModule::class,
                'module' => 'Port',
                'methods' => $this->crudMethods($bulkRows),
            ],
            [
                'accessor' => 'module_port_backend',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\PortBackendApiModule::class,
                'module' => 'PortBackend',
                'methods' => $this->crudMethods($bulkRows),
            ],
            [
                'accessor' => 'module_protection',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\ProtectionApiModule::class,
                'module' => 'Protection',
                'methods' => $this->queryMethods(),
            ],
            [
                'accessor' => 'module_region',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\RegionApiModule::class,
                'module' => 'Region',
                'methods' => $this->queryMethods(),
            ],
            [
                'accessor' => 'module_ssl_options',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\SSLOptionsApiModule::class,
                'module' => 'SSLOptions',
                'methods' => array_merge($this->queryMethods(), [
                    ['name' => 'update', 'args' => [['id' => 7], ['redirect_https' => 'yes']], 'expected_data' => ['query' => ['id' => 7], 'value' => ['redirect_https' => 'yes']]],
                    ['name' => 'bulk', 'args' => [$bulkRows], 'expected_data' => ['rows' => $bulkRows]],
                ]),
            ],
            [
                'accessor' => 'module_ssl_user',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\SSLUserApiModule::class,
                'module' => 'SSLUser',
                'methods' => array_merge($this->queryMethods(), [
                    ['name' => 'create', 'args' => [['domain' => 'created.example.test']], 'expected_data' => ['value' => ['domain' => 'created.example.test']]],
                    ['name' => 'delete', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'bulk', 'args' => [[
                        'new' => ['value' => ['domain' => 'bulk.example.test']],
                    ]], 'expected_data' => ['rows' => [
                        'new' => ['value' => ['domain' => 'bulk.example.test']],
                    ]]],
                    ['name' => 'enable', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'disable', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'group', 'args' => [['id' => 7], ['target' => 8]], 'expected_data' => ['query' => ['id' => 7], 'value' => ['target' => 8]]],
                    ['name' => 'retry', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'renew', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'ungroup', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                ]),
            ],
            [
                'accessor' => 'module_server',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\ServerApiModule::class,
                'module' => 'Server',
                'methods' => $this->queryMethods(),
            ],
            [
                'accessor' => 'module_service',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\ServiceApiModule::class,
                'module' => 'Service',
                'methods' => [
                    ['name' => 'all', 'args' => [['user' => 1]], 'expected_data' => ['query' => ['user' => 1]]],
                ],
            ],
            [
                'accessor' => 'module_task_request',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\TaskRequestApiModule::class,
                'module' => 'TaskRequest',
                'methods' => $this->taskRequestMethods(),
            ],
            [
                'accessor' => 'module_tier',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\TierApiModule::class,
                'module' => 'Tier',
                'methods' => $this->queryMethods(),
            ],
            [
                'accessor' => 'module_tunnel',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\TunnelApiModule::class,
                'module' => 'Tunnel',
                'methods' => array_merge($this->crudMethods($bulkRows), [
                    ['name' => 'latest_versions', 'args' => [], 'expected_data' => []],
                    ['name' => 'script', 'args' => [['tunnels' => '1,2', 'os' => 'linux']], 'expected_data' => ['tunnels' => '1,2', 'os' => 'linux']],
                    ['name' => 'upgrade', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                ]),
            ],
            [
                'accessor' => 'module_user',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\UserApiModule::class,
                'module' => 'User',
                'methods' => [
                    ['name' => 'describe', 'args' => [], 'expected_data' => []],
                    ['name' => 'login', 'args' => ['user@example.test', 'secret'], 'expected_data' => ['email' => 'user@example.test', 'password' => 'secret']],
                    ['name' => 'isLoggedIn', 'args' => [], 'expected_data' => []],
                    ['name' => 'enable_2fa', 'args' => [], 'expected_data' => []],
                ],
            ],
            [
                'accessor' => 'module_zone',
                'accessor_args' => [],
                'class' => \Splitice\X4B\Modules\ZoneApiModule::class,
                'module' => 'Zone',
                'methods' => array_merge($this->crudMethods($bulkRows), [
                    ['name' => 'move_up', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                    ['name' => 'move_down', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
                ]),
            ],
        ];
    }

    /**
     * Build the standard query-method expectation set.
     *
     * @return list<array{name: string, args: list<mixed>, expected_data: array<string, mixed>}>
     */
    private function queryMethods(): array
    {
        return [
            ['name' => 'all', 'args' => [['lease' => 1]], 'expected_data' => ['query' => ['lease' => 1]]],
            ['name' => 'get', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
            ['name' => 'describe', 'args' => [], 'expected_data' => []],
        ];
    }

    /**
     * Build the standard CRUD-method expectation set.
     *
     * @param array<int|string, array<string, mixed>> $bulkRows Bulk rows fixture.
     * @return list<array{name: string, args: list<mixed>, expected_data: array<string, mixed>}>
     */
    private function crudMethods(array $bulkRows): array
    {
        return [
            ['name' => 'all', 'args' => [['lease' => 1]], 'expected_data' => ['query' => ['lease' => 1]]],
            ['name' => 'get', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
            ['name' => 'describe', 'args' => [], 'expected_data' => []],
            ['name' => 'create', 'args' => [['name' => 'created']], 'expected_data' => ['value' => ['name' => 'created']]],
            ['name' => 'update', 'args' => [['id' => 7], ['name' => 'updated']], 'expected_data' => ['query' => ['id' => 7], 'value' => ['name' => 'updated']]],
            ['name' => 'delete', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
            ['name' => 'bulk', 'args' => [$bulkRows], 'expected_data' => ['rows' => $bulkRows]],
        ];
    }

    /**
     * Build the TaskRequest-specific method expectation set.
     *
     * @return list<array{name: string, args: list<mixed>, expected_data: array<string, mixed>}>
     */
    private function taskRequestMethods(): array
    {
        return [
            ['name' => 'all', 'args' => [['lease' => 1]], 'expected_data' => ['query' => ['lease' => 1]]],
            ['name' => 'get', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
            ['name' => 'describe', 'args' => [], 'expected_data' => []],
            [
                'name' => 'create',
                'args' => [[
                    'lease' => 1,
                    'action' => 'ping',
                    'from' => '1.1.1.1',
                    'to' => '127.0.0.1',
                ]],
                'expected_data' => [
                    'value' => [
                        'lease' => 1,
                        'action' => 'ping',
                        'from' => '1.1.1.1',
                        'to' => '127.0.0.1',
                    ],
                ],
            ],
            ['name' => 'delete', 'args' => [['id' => 7]], 'expected_data' => ['query' => ['id' => 7]]],
        ];
    }
}
