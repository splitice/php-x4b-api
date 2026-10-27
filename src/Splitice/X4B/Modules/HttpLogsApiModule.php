<?php

namespace Splitice\X4B\Modules;

/** Customer HTTP telemetry with the documented top-level filtering parameters. */
class HttpLogsApiModule extends Base\ApiModuleClient
{
    /**
     * Execute the documented HTTP telemetry action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function summary(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented HTTP telemetry action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function graph(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /**
     * Execute the documented HTTP telemetry action.
     * @param array<string, mixed> $data Action parameters.
     * @return mixed
     */
    public function describe(array $data = []): mixed
    {
        return $this->api_execute(__FUNCTION__, $data);
    }

    /** Return the canonical module name. */
    protected function module_name(): string
    {
        return 'HttpLogs';
    }
}
