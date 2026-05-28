<?php

namespace Splitice\X4B\Wrapper;

class Lease extends AbstractRecordWrapper
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
        return $this->firstRecord($this->api()->module_lease()->all(['id' => $this->getId()]), 'Lease');
    }

    public function getType(): ?string
    {
        return $this->getStringField('type');
    }

    public function getCurrentUsage(): mixed
    {
        return $this->getField('current_usage');
    }

    public function getStatus(): ?string
    {
        return $this->getStringField('status');
    }

    public function getService(): ?Service
    {
        $serviceId = $this->getIdentifierField('service');
        if ($serviceId === null) {
            return null;
        }

        return Service::fromId($serviceId, $this->api());
    }

    public function getPlan(): ?Plan
    {
        $plan = $this->getArrayField('plan');
        if ($plan !== null) {
            return Plan::fromRecord($plan, $this->api());
        }

        return null;
    }

    /**
     * @return list<LeaseIP>
     */
    public function getLeaseIps(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_lease_ip()->all(['lease' => $this->getId()]),
            fn (array $record): LeaseIP => LeaseIP::fromRecord($record, $this->api())
        );
    }

    /**
     * @return list<Port>
     */
    public function getPorts(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_port()->all(['lease' => $this->getId()]),
            fn (array $record): Port => Port::fromRecord($record, $this->api())
        );
    }

    /**
     * @return list<Tunnel>
     */
    public function getTunnels(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_tunnel()->all(['lease' => $this->getId()]),
            fn (array $record): Tunnel => Tunnel::fromRecord($record, $this->api())
        );
    }

    /**
     * @return list<TaskRequest>
     */
    public function getTaskRequests(): array
    {
        return $this->wrapRecordList(
            $this->api()->module_task_request()->all(['lease' => $this->getId()]),
            fn (array $record): TaskRequest => TaskRequest::fromRecord($record, $this->api(), $this->getId())
        );
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createPort(array $value): mixed
    {
        return $this->api()->module_port()->create(['lease' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createTunnel(array $value): mixed
    {
        return $this->api()->module_tunnel()->create(['lease' => $this->getId()] + $value);
    }

    /**
     * @param array<string, mixed> $value
     */
    public function createTaskRequest(array $value): mixed
    {
        return $this->api()->module_task_request()->create(['lease' => $this->getId()] + $value);
    }
}
