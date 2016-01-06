<?php
namespace Splitice\X4B\Authorization;


interface IX4BApiAuthorization
{

	/**
	 * Perform authentication,
	 * @param array $data data that may be filtered
	 */
	public function perform(&$data);
}