<?php
namespace Splitice\X4B\Client;
use Splitice\X4B\Exceptions\ApiTransportException;

/**
 * X4B APIv2 Client using JSON encoding
 * @package Splitice\X4B
 */
class X4BApiClient implements IX4BApiClient
{
    const URL = "https://www.x4b.net/apiv2/";
    private $ch;
    private $url;

    function __construct($url = self::URL){
        $this->url = $url;

        //Setup curl
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_POST, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    }

    private function build_url($module, $method){
        return rtrim($this->url,'/').'/'.$module.'/'.$method;
    }

    function __destruct(){
        curl_close($this->ch);
    }

    public function execute($module,$action, $data = array()){
        //set curl
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($this->ch, CURLOPT_URL, $this->build_url($module, $action));

        //Execute request
        $data = curl_exec($this->ch);
        $code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        //Handle response
        if($code == 200){
            return json_decode($data, true);
        }else{
            throw new ApiTransportException($code);
        }
    }
}