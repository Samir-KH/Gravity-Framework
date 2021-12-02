<?php
/**
 * This file is a part of this mini framwork
 * This class is the kernel of this mini framwork in another word the core
 * 
 */
namespace App\Configuration;

use App\Configuration\Config;


class RouterConfig {
    /**
     * this class used to get the configurations of the router
     * it uses the Config class which able to read configuration file
     * the function get content use Config::getContent to get content of the fille $file
     * so for every configuration file there is fucntion getContent, for exemple to get content of the routes file we use getRoutesContent()
     * we can't create our own function to get content of our configuration's file
     * define a variable $configfile = "configfileName" then  we  use getContents($file)
     */

    public static $routes = "routes";
    private static $exthension ="json";
    private static $component = "Router";

    private static function getContents($file)
    {
        return Config::getContent(RouterConfig::$component,$file, RouterConfig::$exthension, RouterConfig::$exthension);
    }
    
    public static function getRoutesContent()
    {
        return RouterConfig::getContents(RouterConfig::$routes);
    }


}