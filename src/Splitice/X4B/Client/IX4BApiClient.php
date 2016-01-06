<?php
namespace Splitice\X4B\Client;

/**
 * An interface for a X4B APIv2 compatible client
 *
 * @package Splitice\X4B
 */
interface IX4BApiClient
{
    /**
     * Execute an APIv2 request
     *
     * @param $module
     * @param string $action
     * @param array $data
     * @return array
     */
    function execute($module, $action, $data = array());
}