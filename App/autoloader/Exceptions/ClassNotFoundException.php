<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace App\Autoloader\Exceptions;

class ClassNotFoundException extends \Exception {

    protected $message = "ClassNotFoundExeption: Auloloader failed to load the class "; 

    public function __construct($className){

        $this->message = $this->message.$className;

    }
    
}