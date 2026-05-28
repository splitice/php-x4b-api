<?php

use PHPUnit\Framework\TestCase;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\X4BApi;

final class CrudTest extends TestCase
{
    public function testAll(): void
    {
        $selector = ['lease' => 1];

        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'all', ['query' => $selector]);

        $api = new X4BApi($client);
        $api->module_port()->all($selector);
    }

    public function testGet(): void
    {
        $selector = ['lease' => 1];

        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'get', ['query' => $selector]);

        $api = new X4BApi($client);
        $api->module_port()->get($selector);
    }

    public function testDelete(): void
    {
        $selector = ['lease' => 1];

        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'delete', ['query' => $selector]);

        $api = new X4BApi($client);
        $api->module_port()->delete($selector);
    }

    public function testUpdate(): void
    {
        $selector = ['lease' => 1];
        $value = ['protocol' => 1];

        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'update', ['query' => $selector, 'value' => $value]);

        $api = new X4BApi($client);
        $api->module_port()->update($selector, $value);
    }

    public function testInsert(): void
    {
        $value = ['protocol' => 1];

        $client = $this->createMock(IX4BApiClient::class);
        $client->expects($this->once())
            ->method('execute')
            ->with('Port', 'insert', ['value' => $value]);

        $api = new X4BApi($client);
        $api->module_port()->insert($value);
    }
}
