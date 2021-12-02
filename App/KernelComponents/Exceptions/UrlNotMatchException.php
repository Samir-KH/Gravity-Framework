<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace  App\KernelComponents\Exceptions;

class UrlNotMatchException extends \Exception {

    protected $message = "UrlNotMatchException:  not found url  "; 

    public function __construct(){

        $this->message = $this->message;

    }
    
}