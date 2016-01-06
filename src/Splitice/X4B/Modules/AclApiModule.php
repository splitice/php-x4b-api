<?php
namespace Splitice\X4B\Modules;


use Splitice\X4B\Authorization\IX4BApiAuthorization;
use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Exceptions\ApiException;

class AclApiModule extends Base\CrudApiModule
{
	private $target;

	function __construct(IX4BApiClient $api, IX4BApiAuthorization $auth, $target)
	{
		$this->target = $target;
		parent::__construct($api, $auth);
	}


	protected function api_execute($module, $method, $data){
		$data['acl_type'] = $this->target;
		return parent::api_execute($module, $method, $data);
	}

	protected function module_name()
	{
		return 'ACL';
	}

	function moveUp($selector){
		if($this->target != 'http') throw new ApiException(__FUNCTION__.' is only valid on http type ACLs');
		return $this->api_execute($this->module_name(), __FUNCTION__, array('query'=>$selector));
	}

	function moveDown($selector){
		if($this->target != 'http') throw new ApiException(__FUNCTION__.' is only valid on http type ACLs');
		return $this->api_execute($this->module_name(), __FUNCTION__, array('query'=>$selector));
	}
}