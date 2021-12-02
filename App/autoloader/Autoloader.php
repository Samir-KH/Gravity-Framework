<?php

/**
 * this file is a part of this mini framwork
 * 
 * this class is the autoloader used
 * 
 */
namespace App\Autoloader ;

use App\Autoloader\Exceptions\ClassNotFoundException;


class Autoloader{

    private static  $paths_bag = array(
        "" ,
        "/vendor",
        "/src",
    );

    public static function autoload(){
        spl_autoload_register(array(__CLASS__, "callable_autoload"));
    }

    private static function classePath($className){
        return str_replace('\\', '/', $className);
    }

    private static function raiseClassNotFoundException($className){
        throw new ClassNotFoundException($className);
    }

    private static function callable_autoload($className){

        $classPath = Autoloader::classePath($className);
        $main_dir = dirname(dirname(__DIR__));

        foreach(Autoloader::$paths_bag as $path){
            $full_path = $main_dir.$path.'/'.$classPath.'.php' ;
            
            if ( file_exists($full_path) ){
                require_once  $full_path ;
                return ;
            }
        }
        Autoloader::raiseClassNotFoundException($className);     
    }
}