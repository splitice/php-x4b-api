<?php
namespace Splitice\X4B\Wrapper;


use Splitice\X4B\Modules\Base\CrudApiModule;

trait TCrudWrapper
{
	/**
	 * @return CrudApiModule
	 */
	abstract protected function moduleApi();
	abstract protected function moduleDataFilter($function, &$data);
	abstract protected function getApiValue();
	abstract protected function getApiQuery();

	function insert($data = array()){
		$this->moduleDataFilter(__FUNCTION__, $data);
		$this->moduleApi()->insert($this->getApiValue(), $data);
	}

	function delete($data = array()){
		$this->moduleDataFilter(__FUNCTION__, $data);
		$this->moduleApi()->delete($this->getApiQuery(), $data);
	}

	function update($data = array()){
		$this->moduleDataFilter(__FUNCTION__, $data);
		$this->moduleApi()->update($this->getApiQuery(), $this->getApiValue(), $data);
	}

	function get($data = array()){
		$this->moduleDataFilter(__FUNCTION__, $data);
		$this->moduleApi()->get($this->getApiQuery(), $data);
	}
}