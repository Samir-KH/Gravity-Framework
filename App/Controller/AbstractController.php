<?php
/**
 * This file is a part of this mini framwork
 * This class must be inherited by any controller
 * 
 */
namespace App\Controller;


use App\HttpComponents\Response;
use App\Templates\TemplatesManager;
//use App\DataBase\DataBaseConnector;

class AbstractController{

    public $request;
    public $routes ;
    public $cM ; 

    public function __construct($request,$routes,$dataBaseConnectorManager)
    {
        $this->request = $request;
        $this->routes = $routes;
        $this->cM = $dataBaseConnectorManager;
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
    public function redirectionToRoute($route,$domain)
    {
        $url_route = $this->routes->$route->url;
        $response = new Response();
        $response->setHeader("Location",$domain.$url_route);
        return $response;
    }

    
}