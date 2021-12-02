<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace  App\Configuration\Exceptions;

class ConfigFileNotFoundException extends \Exception {

    protected $message = "ConfigFileNotFoundException:  fonfiguration file not found "; 

    public function __construct($File){

        $this->message = $this->message.$File;

    }
    
}