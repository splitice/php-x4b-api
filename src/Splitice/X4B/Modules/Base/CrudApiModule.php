<?php
namespace Splitice\X4B\Modules\Base;


abstract class CrudApiModule extends ApiModuleClient
{
	abstract protected function module_name();

	function all($selector, array $data = array()){
		$data['query'] = $selector;
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function insert($value, array $data = array()){
		$data['value'] = $value;
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function update($selector, $value, array $data = array()){
		$data['query'] = $selector;
		$data['value'] = $value;
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function get($selector, array $data = array()){
		$data['query'] = $selector;
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function delete($selector, array $data = array()){
		$data['query'] = $selector;
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
	function describe(array $data = array()){
		return $this->api_execute($this->module_name(), __FUNCTION__, $data);
	}
}