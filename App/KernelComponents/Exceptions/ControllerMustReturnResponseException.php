<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace  App\KernelComponents\Exceptions;

class ControllerMustReturnResponseException extends \Exception {

    protected $message = "ControllerMustReturnResponseException: the controller must return a Response type : "; 

    public function __construct($controller_name, $method){

        $this->message = $this->message.get_class($controller_name)." at method ".$method;

    }
    
}
