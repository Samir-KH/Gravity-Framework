<?php
/**
 * 
 * this file is a part of this mini framwork
 * this class is the RequireClassExeption 
 * 
 */
namespace App\Templates\Exceptions;



class NoSuchTemplateException extends \Exception {

    protected $message = "NoSuchTemplateException: The template'sfile :"; 

    public function __construct($file){

        $this->message = $this->message."\"".$file."\"doesn't exist";

    }
    
}