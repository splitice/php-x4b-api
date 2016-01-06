<?php
namespace Splitice\X4B\Exceptions;

/**
 * HTTP Transport exception
 *
 * @package Splitice\X4B
 */
class ApiTransportException extends \Exception {
    public $http_code;

    function __construct($http_code){
        $this->http_code = $http_code;
    }
} 