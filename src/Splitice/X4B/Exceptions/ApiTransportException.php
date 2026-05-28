<?php

namespace Splitice\X4B\Exceptions;

/**
 * HTTP Transport exception
 */
class ApiTransportException extends \Exception
{
    public int $http_code;

    public function __construct(int $http_code, string $message = '')
    {
        $this->http_code = $http_code;

        parent::__construct(
            $message !== '' ? $message : sprintf('HTTP transport failed with status code %d.', $http_code),
            $http_code
        );
    }

    public function getHttpCode(): int
    {
        return $this->http_code;
    }
}
