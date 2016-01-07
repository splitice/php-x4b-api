<?php
namespace Splitice\X4B\Authorization;


use Splitice\X4B\Client\IX4BApiClient;
use Splitice\X4B\Exceptions\ApiAuthorizationException;

class UsernameAuthorization implements IX4BApiAuthorization
{
	private $username;
	private $password;
	private $logged_in = false;

	function __construct($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
	}

	public function perform(IX4BApiClient $api, &$data)
	{
		if(!$this->logged_in) {
			$resp = $api->execute('User','login',array('username'=>$this->username,'password'=>$this->password));
			if(!$resp || $resp['status'] != 'ok'){
				throw new ApiAuthorizationException();
			}
			$this->logged_in = true;
		}
	}
}