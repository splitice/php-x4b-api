<?php
namespace Splitice\X4B\Wrapper;


use Splitice\X4B\X4BApi;

class ACL
{
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
	private function aclApi(){
		return $this->api->module_acl($this->target);
	}

	public function moveUp(){
		return $this->aclApi()->moveUp(array('id'=>$this->id));
	}

	public function moveDown(){
		return $this->aclApi()->moveDown(array('id'=>$this->id));
	}

	/**
	 * @param $id
	 * @param X4BApi $api
	 * @return ACL
	 */
	static function fromId($id, X4BApi $api, $target){
		return new static(array('id'=>$id), $api, $target);
	}
}