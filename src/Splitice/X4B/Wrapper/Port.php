<?php

namespace Splitice\X4B\Wrapper;

class Port extends AbstractRecordWrapper
{
    use TRecordWrapperFactory;

    /**
     * @param array<string, mixed> $fields
     */
    public function __construct(array $fields, \Splitice\X4B\X4BApi $api)
    {
        parent::__construct($fields, $api);
    }

    /**
     * @return array<string, mixed>
     */
    protected function loadData(): array
    {
        /** @var array<string, mixed> $record */
        $record = $this->api()->module_port()->get(['id' => $this->getId()]);

        return $record;
    }

    public function getLower(): mixed
    {
        return $this->getField('lower');
    }

    public function getUpper(): mixed
    {
        return $this->getField('upper');
    }

    public function getProtocol(): ?string
    {
        return $this->getStringField('protocol');
    }

    public function getDomain(): ?string
    {
        return $this->getStringField('domain');
    }

    public function getMethod(): ?string
    {
        return $this->getStringField('method');
    }

    public function getBackendMode(): ?string
    {
        return $this->getStringField('backend_mode');
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function isHttpLike(): bool
    {
        return in_array((string) $this->getProtocol(), ['http', 'https'], true);
    }

    public function isHttps(): bool
    {
        return $this->getProtocol() === 'https';
    }

    public function getLease(): ?Lease
    {
        $leaseId = $this->getIdentifierField('lease');
        if ($leaseId === null) {
            return null;
        }

        return Lease::fromId($leaseId, $this->api());
    }

    public function getRegion(): ?Region
    {
        $regionId = $this->getIdentifierField('region');
        if ($regionId === null) {
            return null;
        }

        return Region::fromId($regionId, $this->api());
    }

    public function getFirewallProfile(): ?FirewallProfile
    {
        $profileId = $this->getIdentifierField('fw');
        if ($profileId !== null) {
            return FirewallProfile::fromRecord(['id' => $profileId, 'port' => $this->getId()], $this->api());
        }

        return FirewallProfile::fromPortId($this->getId(), $this->api());
    }

    public function getHttpOption(): ?HttpOption
    {
        if (!$this->isHttpLike()) {
            return null;
        }

        return HttpOption::fromPortId($this->getId(), $this->api());
    }

    public function getSSLOptions(): ?SSLOptions
    {
        if (!$this->isHttps()) {
            return null;
        }

        $sslOptionId = $this->getIdentifierField('ssl_option');
        if ($sslOptionId === null) {
            return SSLOptions::fromPortId($this->getId(), $this->api());
        }

        return SSLOptions::fromRecord(['id' => $sslOptionId, 'port' => $this->getId()], $this->api());
    }

    /**
     * @return list<PortBackend>
     */
    public function getBackends(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_port_backend()->all(['port' => $this->getId()]),
            fn (array $record): PortBackend => PortBackend::fromRecord($record + ['port' => $this->getId()], $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createBackend(array $value): mixed
    {
        return $this->api()->module_port_backend()->create(['port' => $this->getId()] + $value);
    }

    /**
     * @return list<Zone>
     */
    public function getZones(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_zone()->all(['port' => $this->getId()]),
            fn (array $record): Zone => Zone::fromRecord($record + ['port' => $this->getId()], $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createZone(array $value): mixed
    {
        return $this->api()->module_zone()->create(['port' => $this->getId()] + $value);
    }

    /**
     * @return list<ErrorPage>
     */
    public function getErrorPages(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_error_page()->all(['port' => $this->getId()]),
            fn (array $record): ErrorPage => ErrorPage::fromRecord($record + ['port' => $this->getId()], $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createErrorPage(array $value): mixed
    {
        return $this->api()->module_error_page()->create(['port' => $this->getId()] + $value);
    }

    /**
     * @return list<Layer7Rule>
     */
    public function getLayer7Rules(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_layer7_rule()->all(['port' => $this->getId()]),
            fn (array $record): Layer7Rule => Layer7Rule::fromRecord($record + ['port' => $this->getId()], $this->api())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createLayer7Rule(array $value): mixed
    {
        return $this->api()->module_layer7_rule()->create(['port' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createLayer7DropRule(array $value): mixed
    {
        return $this->api()->module_layer7_rule()->create_drop(['port' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createLayer7RateBlacklistRule(array $value): mixed
    {
        return $this->api()->module_layer7_rule()->create_rate_blacklist(['port' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createLayer7RateWhitelistRule(array $value): mixed
    {
        return $this->api()->module_layer7_rule()->create_rate_whitelist(['port' => $this->getId()] + $value);
    }

    /**
     * @return list<ACL>
     */
    public function getHttpAcls(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_acl('http')->all(['port' => $this->getId()]),
            fn (array $record): ACL => ACL::fromRecord($record, $this->api(), 'http', $this->getId())
        );
    }

    /**
     * @return list<ACL>
     */
    public function getDroplistAcls(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_acl('droplist')->all(['port' => $this->getId()]),
            fn (array $record): ACL => ACL::fromRecord($record, $this->api(), 'droplist', $this->getId())
        );
    }

    /**
     * @return list<ACL>
     */
    public function getACLs(): array
    {
        return $this->getAclType() === 'http' ? $this->getHttpAcls() : $this->getDroplistAcls();
    }

    public function getAclType(): string
    {
        return $this->isHttpLike() ? 'http' : 'droplist';
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createHttpAcl(array $value): mixed
    {
        return $this->api()->module_acl('http')->create(['port' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createDroplistAcl(array $value): mixed
    {
        return $this->api()->module_acl('droplist')->create(['port' => $this->getId()] + $value);
    }

    public function getWhitelist(): L7List
    {
        return L7List::whitelist($this->getId(), $this->api());
    }

    public function getBlacklist(): L7List
    {
        return L7List::blacklist($this->getId(), $this->api());
    }
}
