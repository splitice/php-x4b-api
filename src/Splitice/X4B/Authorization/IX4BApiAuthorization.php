<?php
namespace Splitice\X4B\Authorization;


use Splitice\X4B\Client\IX4BApiClient;

interface IX4BApiAuthorization
{

	/**
	 * Perform authentication,
	 * @param IX4BApiClient $api
	 * @param array $data data that may be filtered
	 * @return
	 */
	public function perform(IX4BApiClient $api, &$data);
}