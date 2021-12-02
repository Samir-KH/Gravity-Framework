<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace App\Router\Exceptions;

class BadUrlDefinitionException extends \Exception {

    protected $message = "BadUrlDefinitionException: In the url :"; 

    public function __construct($routeUrl){

        $this->message = $this->message."\"".$routeUrl."\"";

    }
    
}