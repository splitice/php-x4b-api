<?php
use Splitice\X4B\X4BApi;

class CrudTest extends PHPUnit_Framework_TestCase {
    const API_CLIENT = '\\Splitice\\X4B\\Client\\IX4BApiClient';

    function testAll(){
        //Setup
        $selector = array('lease'=>1);

        //Assert
        $client = $this->getMock(self::API_CLIENT);
        $client->expects($this->once())->method('execute')->with($this->equalTo('Port'),$this->equalTo('all'),$this->equalTo(array('query'=>$selector)));

        //Do
        $api = new X4BApi($client);
        $api->module_port()->all($selector);
    }

} 