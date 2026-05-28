<?php

namespace Splitice\X4B\Modules;

class ErrorPageApiModule extends Base\CrudApiModule
{
    /**
     * Get the API module name.
     */
    protected function module_name(): string
    {
        return 'ErrorPage';
    }
}
