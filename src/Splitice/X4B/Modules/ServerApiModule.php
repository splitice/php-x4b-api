<?php

namespace Splitice\X4B\Modules;

class ServerApiModule extends Base\QueryApiModule
{
    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'Server';
    }
}
