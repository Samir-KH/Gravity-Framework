<?php
/**
 * This file is a part of this mini framwork
 * This class is a part of httpComponents of this mini framwork in another word the core
 * 
 */
namespace App\HttpComponents;

class Request{


    const METHOD_GET = "GET";
    const METHOD_POST = "POST";
    const METHOD_PUT = "PUT";
    const METHOD_DELETE = "DELETE";

    private $url ;
    private $request_bag ;
    private $query_bag ;
    private $method ;
    private $header_bag ; 

    public static function urlFormat($url)
    {
        $pos =  strpos($url,"?");
        if($pos ===false) 
            $pos = strlen($url);
        return substr($url,0,$pos);
    }

    public static function createFromGlobales()
    {
        $request = new Request();
        //$request->setUrl(Request::urlFormat($_SERVER["REQUEST_URI"]));
        $url = '/'
        if (isset($_SERVER["PATH_INFO"])){
            $url = $_SERVER["PATH_INFO"]
        $request->setUrl($url);
        $request->setMethod($_SERVER["REQUEST_METHOD"]);
        $request->setRequest($_POST);
        $request->setQuery($_GET);
        //on utilise pour le moment $_SERVER
        $request->setHeaders($_SERVER);
        return $request;
    }

    public function request($param)
    {
        if (isset($this->request[$param]))
        {
           return  htmlspecialchars($this->request[$param]);
        }
        return NULL;
    }

    public function query($param)
    {
        if (isset($this->query_bag[$param]))
        {
           return  htmlspecialchars($this->query_bag[$param]);
        }
        return NULL;
    }

    public function getRequestMethod()
    {
        return $this->method ;
    }

    public function getRequestUrl()
    {
        return $this->url;
    }

    public function setMethod($method)
    {
        $this->method= $method;
    }

    public function setRequest($request_bag)
    {
        $this->request_bag = $request_bag;
    }

    public function setQuery($query_bag)
    {
        $this->query_bag = $query_bag;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function setHeaders($headers_bag)
    {
        $this->headers_bag = $headers_bag;
    }

    public function getHeader($header)
    {
        if (isset($this->headers_bag[$header]))
            return $this->headers_bag[$header];
        return null;
    }
    
}