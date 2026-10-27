<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\X4BApi;

final class BanAndRuleHitsTest extends TestCase
{
    /** Preserve request envelopes, credentials, selectors, and paging for the new public actions. */
    public function testBanAndHitRequestContracts(): void
    {
        $requests = [];
        $client = $this->createMock(IX4BApiClient::class);
        $client->expects(self::exactly(5))->method('execute')->willReturnCallback(
            static function (string $module, string $action, array $data) use (&$requests): array {
                $requests[] = [$module, $action, $data];
                return ['fixture' => true];
            }
        );
        $api = new X4BApi($client);
        $api->auth_key('fixture-key');
        $bans = $api->module_l4_bans();
        self::assertSame(['fixture' => true], $bans->all(['lip' => 42], ['page' => ['limit' => 3]]));
        $value = ['lip' => 42, 'client_ip' => '192.0.2.1', 'regions' => [1, 2]];
        $bans->ban($value);
        $unban = ['lip' => 42, 'client_ip' => '192.0.2.1', 'region' => 1];
        $bans->unban($unban);
        $bans->describe();
        $api->module_layer7_rule()->hits(['port' => 7]);
        self::assertSame([
            ['L4Bans', 'all', ['page' => ['limit' => 3], 'query' => ['lip' => 42], 'API_KEY' => 'fixture-key']],
            ['L4Bans', 'ban', ['value' => $value, 'API_KEY' => 'fixture-key']],
            ['L4Bans', 'unban', ['value' => $unban, 'API_KEY' => 'fixture-key']],
            ['L4Bans', 'describe', ['API_KEY' => 'fixture-key']],
            ['Layer7Rule', 'hits', ['query' => ['port' => 7], 'API_KEY' => 'fixture-key']],
        ], $requests);
    }
    /** Every added telemetry and passkey action preserves its request fields and credentials. */
    public function testAdditionalCustomerActionContracts(): void
    {
        $client = $this->createMock(IX4BApiClient::class);
        $client->expects(self::exactly(11))->method('execute')->willReturnCallback(
            static fn (string $module, string $action, array $data): array => [$module, $action, $data]
        );
        $api = new X4BApi($client);
        $api->auth_key('fixture-key');
        foreach (['passkey_register_begin', 'passkey_register_finish', 'passkey_auth_options',
            'passkey_auth_begin', 'passkey_auth_finish', 'passkey_delete', 'passkey_update_policy'] as $action) {
            self::assertSame(['User', $action, ['id' => 'example', 'API_KEY' => 'fixture-key']],
                $api->module_user()->{$action}(['id' => 'example']));
        }
        foreach (['summary', 'graph', 'describe'] as $action) {
            self::assertSame(['HttpLogs', $action, ['lease_id' => 42, 'API_KEY' => 'fixture-key']],
                $api->module_http_logs()->{$action}(['lease_id' => 42]));
        }
        self::assertSame(['Layer4Rule', 'hits', ['query' => ['lip' => 42], 'API_KEY' => 'fixture-key']],
            $api->module_layer4_rule()->hits(['lip' => 42]));
    }

}
