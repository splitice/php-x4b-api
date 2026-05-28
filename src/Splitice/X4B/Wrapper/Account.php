<?php

namespace Splitice\X4B\Wrapper;

use Splitice\X4B\X4BApi;

class Account extends AbstractWrapper
{
    public static function fromApi(X4BApi $api): self
    {
        return new self($api);
    }

    /**
     * @return list<Service>
     */
    public function getServices(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_service()->all([]),
            fn (array $record): Service => Service::fromRecord($record, $this->api())
        );
    }

    /**
     * @return list<Lease>
     */
    public function getLeases(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_lease()->all([]),
            fn (array $record): Lease => Lease::fromRecord($record, $this->api())
        );
    }

    /**
     * @return list<DnsZone>
     */
    public function getDnsZones(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_dns_zone()->all([]),
            fn (array $record): DnsZone => DnsZone::fromRecord($record, $this->api())
        );
    }

    /**
     * @return list<SSLUser>
     */
    public function getSSLUsers(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_ssl_user()->all([]),
            fn (array $record): SSLUser => SSLUser::fromRecord($record, $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createDnsZone(array $value): mixed
    {
        return $this->api()->module_dns_zone()->create($value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createSSLUser(array $value): mixed
    {
        return $this->api()->module_ssl_user()->create($value);
    }
}
