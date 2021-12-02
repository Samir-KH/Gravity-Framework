<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace  App\KernelComponents\Exceptions;

class FailedToLoadControllerException extends \Exception {

    protected $message = "FailedToLoadControllerException:  failed to load the controller "; 

    public function __construct($controller_name){

        $this->message = $this->message.$controller_name;

    }
    
}