<?php
namespace Splitice\X4B\Modules\Base;


use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;

abstract class ApiModuleClient
{
	/**
	 * @var IX4BApiClient
	 */
	protected $api;

	/**
	 * @var IX4BApiAuthorization
	 */
	protected $auth;

	function __construct(IX4BApiClient $api, IX4BApiAuthorization $auth = null)
	{
		$this->api = $api;
		$this->auth = $auth;
	}

	protected function api_execute($module, $method, $data){
		if($this->auth !== null){
			$this->auth->perform($data);
		}
		return $this->api->execute($module, $method, $data);
	}
}