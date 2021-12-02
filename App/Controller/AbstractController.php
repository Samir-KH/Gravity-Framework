<?php
/**
 * This file is a part of this mini framwork
 * This class must be inherited by any controller
 * 
 */
namespace App\Controller;


use App\HttpComponents\Response;
use App\Templates\TemplatesManager;
class AbstractController{

    public $request;
    public $routes ;

    public function __construct($request,$routes)
    {
        $this->request = $request;
        $this->routes = $routes;
    }

    public function render($content)
    {
        $response = new Response();
        $response->setContent($content);

        return $response;
    }

    public function getFromPrivate($private_path){
        return "../private/".$private_path;
    }

    public function renderView($view, $parametres = array())
    {
        $response = new Response();
        $response->setContent( TemplatesManager::getTemplateContent($view, $parametres,$this->routes) );
        return $response;
    }

    
}