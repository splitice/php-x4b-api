<?php

namespace Splitice\X4B;

use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Authorization\UsernameAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Client\X4BApiClient;
use Splitice\X4B\Modules\AclApiModule;
use Splitice\X4B\Modules\PortApiModule;

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

    public function auth_key(): void
    {
        /* todo */
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
}
