<?php
namespace Splitice\X4B;


class X4BApi
{
	/**
	 * @var Client\IX4BApiClient
	 */
	private $api;

	/**
	 * @var Authorization\IX4BApiAuthorization
	 */
	private $auth;

	public function __construct(Client\IX4BApiClient $api = null)
	{
		if($api === null){
			$api = new Client\X4BApiClient();
		}
		$this->api = $api;
	}

	public function auth_login($username, $password){
		$this->auth = new Authorization\UsernameAuthorization($username,$password);
	}
	public function auth_key(){
		/* todo */
	}
	public function module_port(){
		return new Modules\PortApiModule($this->api, $this->auth);

	}
	public function module_acl(){
		return new Modules\AclApiModule($this->api, $this->auth);
	}
}