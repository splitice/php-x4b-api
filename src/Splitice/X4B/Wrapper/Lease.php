<?php
namespace Splitice\X4B\Wrapper;


use Splitice\X4B\X4BApi;

class Lease
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

	/**
	 * @return Port[]
	 */
	public function getPorts(){
		$ret = array();
		$port = $this->api->module_port();
		foreach($port->all(array('lease'=>$this->id)) as $port){
			$ret[] = new Port($port, $this->api);
		}
		return $ret;
	}

	/**
	 * @param $id
	 * @param X4BApi $api
	 * @return Lease
	 */
	static function fromId($id, X4BApi $api){
		return new static(array('id'=>$id), $api);
	}
}