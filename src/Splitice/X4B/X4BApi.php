<?php

namespace Splitice\X4B;

use Splitice\X4B\Authorization\ApiKeyAuthorization;
use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Authorization\UsernameAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Client\X4BApiClient;
use Splitice\X4B\Modules\AclApiModule;
use Splitice\X4B\Modules\DnsRecordApiModule;
use Splitice\X4B\Modules\DnsZoneApiModule;
use Splitice\X4B\Modules\ErrorPageApiModule;
use Splitice\X4B\Modules\FirewallProfileApiModule;
use Splitice\X4B\Modules\HttpOptionApiModule;
use Splitice\X4B\Modules\L7ListApiModule;
use Splitice\X4B\Modules\L4BansApiModule;
use Splitice\X4B\Modules\Layer4RuleApiModule;
use Splitice\X4B\Modules\Layer7RuleApiModule;
use Splitice\X4B\Modules\LeaseApiModule;
use Splitice\X4B\Modules\LeaseIPApiModule;
use Splitice\X4B\Modules\PlanApiModule;
use Splitice\X4B\Modules\PortApiModule;
use Splitice\X4B\Modules\PortBackendApiModule;
use Splitice\X4B\Modules\ProtectionApiModule;
use Splitice\X4B\Modules\RegionApiModule;
use Splitice\X4B\Modules\SSLOptionsApiModule;
use Splitice\X4B\Modules\SSLUserApiModule;
use Splitice\X4B\Modules\ServerApiModule;
use Splitice\X4B\Modules\ServiceApiModule;
use Splitice\X4B\Modules\TaskRequestApiModule;
use Splitice\X4B\Modules\TierApiModule;
use Splitice\X4B\Modules\TunnelApiModule;
use Splitice\X4B\Modules\UserApiModule;
use Splitice\X4B\Modules\ZoneApiModule;

class X4BApi
{
    private IX4BApiClient $api;

    private ?IX4BApiAuthorization $auth = null;

    public function __construct(?IX4BApiClient $api = null)
    {
        $this->api = $api ?? new X4BApiClient();
    }

    public function auth_login(string $username, string $password): void
    {
        $this->auth = new UsernameAuthorization($username, $password);
    }

    public function auth_key(string $apiKey): void
    {
        $this->auth = new ApiKeyAuthorization($apiKey);
    }

    public function module_port(): PortApiModule
    {
        return new PortApiModule($this->api, $this->auth);
    }

    /**
     * @param string $target Either http or droplist (TCP/UDP ports).
     */
    public function module_acl(string $target): AclApiModule
    {
        return new AclApiModule($this->api, $this->auth, $target);
    }

    public function module_dns_record(): DnsRecordApiModule
    {
        return new DnsRecordApiModule($this->api, $this->auth);
    }

    public function module_dns_zone(): DnsZoneApiModule
    {
        return new DnsZoneApiModule($this->api, $this->auth);
    }

    public function module_error_page(): ErrorPageApiModule
    {
        return new ErrorPageApiModule($this->api, $this->auth);
    }

    public function module_firewall_profile(): FirewallProfileApiModule
    {
        return new FirewallProfileApiModule($this->api, $this->auth);
    }

    public function module_http_option(): HttpOptionApiModule
    {
        return new HttpOptionApiModule($this->api, $this->auth);
    }

    /** Return the customer Layer 4 ban API. */
    public function module_l4_bans(): L4BansApiModule
    {
        return new L4BansApiModule($this->api, $this->auth);
    }

    public function module_l7_list(): L7ListApiModule
    {
        return new L7ListApiModule($this->api, $this->auth);
    }

    public function module_layer4_rule(): Layer4RuleApiModule
    {
        return new Layer4RuleApiModule($this->api, $this->auth);
    }

    public function module_layer7_rule(): Layer7RuleApiModule
    {
        return new Layer7RuleApiModule($this->api, $this->auth);
    }

    public function module_lease(): LeaseApiModule
    {
        return new LeaseApiModule($this->api, $this->auth);
    }

    public function module_lease_ip(): LeaseIPApiModule
    {
        return new LeaseIPApiModule($this->api, $this->auth);
    }

    public function module_plan(): PlanApiModule
    {
        return new PlanApiModule($this->api, $this->auth);
    }

    public function module_port_backend(): PortBackendApiModule
    {
        return new PortBackendApiModule($this->api, $this->auth);
    }

    public function module_protection(): ProtectionApiModule
    {
        return new ProtectionApiModule($this->api, $this->auth);
    }

    public function module_region(): RegionApiModule
    {
        return new RegionApiModule($this->api, $this->auth);
    }

    public function module_ssl_options(): SSLOptionsApiModule
    {
        return new SSLOptionsApiModule($this->api, $this->auth);
    }

    public function module_ssl_user(): SSLUserApiModule
    {
        return new SSLUserApiModule($this->api, $this->auth);
    }

    public function module_server(): ServerApiModule
    {
        return new ServerApiModule($this->api, $this->auth);
    }

    public function module_service(): ServiceApiModule
    {
        return new ServiceApiModule($this->api, $this->auth);
    }

    public function module_task_request(): TaskRequestApiModule
    {
        return new TaskRequestApiModule($this->api, $this->auth);
    }

    public function module_tier(): TierApiModule
    {
        return new TierApiModule($this->api, $this->auth);
    }

    public function module_tunnel(): TunnelApiModule
    {
        return new TunnelApiModule($this->api, $this->auth);
    }

    public function module_user(): UserApiModule
    {
        return new UserApiModule($this->api, $this->auth);
    }

    public function module_zone(): ZoneApiModule
    {
        return new ZoneApiModule($this->api, $this->auth);
    }
}
