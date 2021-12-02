<?php
/**
 * This file is a part of this mini framwork
 * This class is the router of this mini framwork 
 * the handling with the bad definitions is almoste done  !!!!!!!!!
 * 
 *but the management of the bad definitions route file is not yet complete !!!!!!!!!
 */
namespace App\Router;

use App\Router\RouterRegex;

class Router{

    private $url_method;

    private $url;

    private $routes;

    private $result;

    private $parametresValues = array();

    public function prepare($url_method, $url, $routes)
    {
        $this->url_method = $url_method;
        $this->url = $url;
        $this->routes = $routes;
        
    }

    public function urlHandle()
    {
        if ($route = $this->getPropreRoute($this->url_method, $this->url) )
        {
            $result["controller"] = $route["route"]->controller;
            $result["method"] = $route["route"]->method;
            $result["parametres"] = $route["parametres"];
            $this->result = $result;
            return true;
        } 
        return False;
    }

    private function getPropreRoute($url_method, $url){
        foreach ( $this->routes as  $route)
        {
            if ($route->url_method == $url_method )
            {
                if ( $this->matchUrl($route->url, $url))
                {
                    return array(
                        "route" => $route,
                        "parametres" => $this->parametresValues
                        );
                }
            }
        }
        return false;
    }

    private function matchUrl($route_url, $url)
    {
        // First we check if ther are some parameteres then we decide which method of RouterRegex we execute
        //
        $route_info = RouterRegex::prepareRegexAndGetparametresNames($route_url);

        if ($route_info["parametresNames"]){
            $parametresValues = RouterRegex::matchUrlAndGetParametresValues($route_info["regex"], $url, $route_info["parametresNames"]);
            //we test because maybe the values are not compatible with the types
            if ( $parametresValues)
            {
                 $this->parametresValues = $parametresValues;
                 return true;
            }
        }
        //if there is no parametres
        else{
            $matching = RouterRegex::matchUrl($route_info["regex"], $url);
            if ( $matching)
            {
                 return true;
            }
        }
        
        return false;
    }

    public function getResult()
    {
        return $this->result ; // [ "Controller", "method","params" ]
    }
}