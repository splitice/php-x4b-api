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

    function testGet(){
        //Setup
        $selector = array('lease'=>1);

        //Assert
        $client = $this->getMock(self::API_CLIENT);
        $client->expects($this->once())->method('execute')->with($this->equalTo('Port'),$this->equalTo('get'),$this->equalTo(array('query'=>$selector)));

        //Do
        $api = new X4BApi($client);
        $api->module_port()->get($selector);
    }

    function testDelete(){
        //Setup
        $selector = array('lease'=>1);

        //Assert
        $client = $this->getMock(self::API_CLIENT);
        $client->expects($this->once())->method('execute')->with($this->equalTo('Port'),$this->equalTo('delete'),$this->equalTo(array('query'=>$selector)));

        //Do
        $api = new X4BApi($client);
        $api->module_port()->delete($selector);
    }

    function testUpdate(){
        //Setup
        $selector = array('lease'=>1);
        $value = array('protocol'=>1);

        //Assert
        $client = $this->getMock(self::API_CLIENT);
        $client->expects($this->once())->method('execute')->with($this->equalTo('Port'),$this->equalTo('update'),$this->equalTo(array('query'=>$selector,'value'=>$value)));

        //Do
        $api = new X4BApi($client);
        $api->module_port()->update($selector, $value);
    }

    function testInsert(){
        //Setup
        $value = array('protocol'=>1);//not complete

        //Assert
        $client = $this->getMock(self::API_CLIENT);
        $client->expects($this->once())->method('execute')->with($this->equalTo('Port'),$this->equalTo('update'),$this->equalTo(array('value'=>$value)));

        //Do
        $api = new X4BApi($client);
        $api->module_port()->insert($value);
    }
} 