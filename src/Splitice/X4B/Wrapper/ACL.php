<?php
namespace Splitice\X4B\Wrapper;


use Splitice\X4B\X4BApi;

class ACL
{
	use TCrudWrapper;

	private $id;
	/**
	 * @var X4BApi
	 */
	private $api;
	private $target;

	public function __construct($fields, X4BApi $api, $target)
	{
		$this->id = $fields['id'];
		$this->target = $target;
		$this->api = $api;
	}

	/**
	 * @return \Splitice\X4B\Modules\AclApiModule
	 */
	protected function moduleApi(){
		return $this->api->module_acl($this->target);
	}
	protected function moduleDataFilter($function, &$data){
		$data['acl_type'] = $this->target;
	}
	protected function getApiValue(){
		return array();
	}
	protected function getApiQuery(){
		return array('id'=>$this->id);
	}

	public function moveUp(){
		return $this->moduleApi()->moveUp(array('id'=>$this->id));
	}

	public function moveDown(){
		return $this->moduleApi()->moveDown(array('id'=>$this->id));
	}

	/**
	 * @param $id
	 * @param X4BApi $api
	 * @param $target
	 * @return ACL
	 */
	static function fromId($id, X4BApi $api, $target){
		return new static(array('id'=>$id), $api, $target);
	}
}