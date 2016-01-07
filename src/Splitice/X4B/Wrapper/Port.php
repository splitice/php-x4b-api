<?php
namespace Splitice\X4B\Wrapper;


use Splitice\X4B\X4BApi;

class Port
{
	private $id;
	/**
	 * @var X4BApi
	 */
	private $api;

	public function __construct($fields, X4BApi $api)
	{
		$this->id = $fields['id'];
		$this->api = $api;
	}

	public function getAclType(){
		return 'http';
	}

	/**
	 * @return ACL[]
	 */
	function getACLs(){
		$ret = array();
		$target = $this->getAclType();
		$module = $this->api->module_acl($target);
		foreach($module->all(array('port'=>$this->id)) as $module){
			$ret[] = new ACL($module, $this->api, $target);
		}
		return $ret;
	}

	/**
	 * @param $id
	 * @param X4BApi $api
	 * @return Port
	 */
	static function fromId($id, X4BApi $api){
		return new static(array('id'=>$id), $api);
	}
}