<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace  App\KernelComponents\Exceptions;

class FailedToExecuteMethodException extends \Exception {

    protected $message = "FailedToExecuteMethodException:  failed to execute method  "; 

    public function __construct($controller_name, $method){

        $this->message = $this->message.$method." at controller ".get_class($controller_name);

    }
    
}