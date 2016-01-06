<?php
namespace Splitice\X4B\Modules\Base;


abstract class CrudApiModule extends ApiModuleClient
{
	abstract protected function module_name();

	function all($data){
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function insert($data){
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function update($data){
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function get($data){
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function describe($data){
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
}