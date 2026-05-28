<?php

namespace Splitice\X4B\Modules;

class DnsZoneApiModule extends Base\CrudApiModule
{
    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'DnsZone';
    }
}
