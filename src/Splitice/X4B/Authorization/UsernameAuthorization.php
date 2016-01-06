<?php
namespace Splitice\X4B\Authorization;


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

	public function perform(&$data)
	{
		if($this->logged_in) {
			// TODO: Implement perform() method.
		}
	}
}