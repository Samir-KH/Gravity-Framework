<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace App\Router\Exceptions;

class BadTypeOfUrlParametreException extends \Exception {

    protected $message = "BadTypeOfUrlParametreException: The Type in  :"; 

    public function __construct($type, $url_route){

        $this->message = $this->message."\"".$type."\"in the route url \"".$url_route."\" is not defined";

    }
    
}