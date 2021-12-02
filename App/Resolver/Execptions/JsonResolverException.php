<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace  App\Resolver\Exceptions;

class JsonResolverException extends \Exception {

    protected $message = "JsonResolverException:  failed to resolve "; 

    public function __construct($jsonFile){

        $this->message = $this->message.$jsonFile;

    }
    
}